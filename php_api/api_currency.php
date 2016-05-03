<?php
error_reporting((E_ALL | E_STRICT) ^ E_NOTICE);
defined('CURRENCY_API_DB_HOST') or define("CURRENCY_API_DB_HOST", "localhost"); // Mysql host
defined('CURRENCY_API_DB_USER') or define("CURRENCY_API_DB_USER", "root"); // Mysql user
defined('CURRENCY_API_DB_PASSWORD') or define("CURRENCY_API_DB_PASSWORD", ""); // Mysql password
defined('CURRENCY_API_DB_DBNAME') or define("CURRENCY_API_DB_DBNAME", "nigerianseminars2"); // Database name
defined('CURRENCY_API_DB_PORT') or define('CURRENCY_API_DB_PORT', ini_get('mysqli.default_port')); // Don't change unless you are sure what you do.
defined('CURRENCY_API_SOCKET') or define('CURRENCY_API_SOCKET', ini_get('mysqli.default_socket')); // Don't change unless you are sure what you do.

class DBException extends Exception {}
class DatabaseHelper {
	protected static $ins;
	private $db;
            
	private function __construct() {
		$this->db = @new MySQLi(
			CURRENCY_API_DB_HOST,
			CURRENCY_API_DB_USER,
			CURRENCY_API_DB_PASSWORD,
			CURRENCY_API_DB_DBNAME,
			CURRENCY_API_DB_PORT,
			CURRENCY_API_SOCKET
		);
		if($this->db->connect_errno) {
				throw new DBException("Could not connect to MySQL Server...");
		}
		$this->db->set_charset("utf8");
	}

	public static function getInstance() {
		if(empty(self::$ins)) {
			try {
				self::$ins = new self();
			} catch(DBException $e) {
				return false;
			}
		}
		return self::$ins;
	}
    
	public function queryScalar($q) {
		$res = $this->query($q);
		$row = $res->fetch_row();
		$res->free_result();
		return $row[0];
	}

	public function query($q) {
		if(!$res = $this->db->query($q))
			throw new DBException(sprintf("Query: %s \n Error: %s", $q, $this->error));
		return $res;
	}
	
	public function __call($method, $arguments) {
		if(!method_exists($this->db, $method)) {
			throw new Exception("Unable to resolve method {$method} in Mysqli class");
		}
		return call_user_func_array(array($this->db, $method), $arguments);
	}
	
	public function __get($name) {
		if(!isset($this->db->$name)) {
			throw new Exception("Unable to resolve property {$method} of Mysqli class");
		}
		return $this->db->$name;
	}
}

class DbProxy {
	private $proxifiedClass;
	private $brokenConn = false;

	function __construct($proxifiedClass) {
		$this->proxifiedClass = $proxifiedClass;
	}

	function __call($method, $arguments) {
		if(!method_exists($this->proxifiedClass, $method) OR $this->brokenConn) {
			return false;
		}
		if(!DatabaseHelper::getInstance()) {
			$this->brokenConn = true;
			return false;
		}
		return call_user_func_array(array($this->proxifiedClass, $method), $arguments);
	}
}

class Currency {
	protected $from, $to, $cacheTime;
	public function __construct($from, $to) {
		$this->from = $from;
		$this->to = $to;
		$this->cacheTime = 60 * 60 * 1;
	}

	public function getFromCache() {
		$db = DatabaseHelper::getInstance();
		$q = "SELECT rate from `api_currency_rate`
		      WHERE
		      `from` = '".$db->real_escape_string($this->from)."'
		      AND
		      `to` = '".$db->real_escape_string($this->to)."'
		      AND
		      `update_time` > '".date("Y-m-d H:i:s", time() - $this->cacheTime)."'";
		return $db->queryScalar($q);
	}

	public function setCache($rate) {
		$db = DatabaseHelper::getInstance();
		$q = "INSERT INTO `api_currency_rate`
            SET
                `from` = '". $db -> real_escape_string($this -> from) ."',
                `to` = '". $db -> real_escape_string($this -> to) ."',
                `rate` = ".(float) $rate .",
                `update_time` = '". date("Y-m-d H:i:s") ."'
            ON DUPLICATE KEY UPDATE
                `rate` = ". (float) $rate .",
                `update_time` = '". date("Y-m-d H:i:s") ."'";
		return $db->query($q);
	}
	
	public function saveStat($providerId) {
		$db = DatabaseHelper::getInstance();
		$q = "INSERT INTO `api_currency_stat`
			SET 
				`date` = '".date("Y-m-d")."',
				`$providerId` = 1
			ON DUPLICATE KEY UPDATE
				`$providerId` = `$providerId` +1";
		return $db->query($q);
	}
}


abstract class CurrencyParser {
	protected $from, $to;

	public function __construct($from, $to) {
		$this -> from = $from;
		$this -> to = $to;
	}

	public function buildRequestUrl() {
		return sprintf($this -> urlPattern, $this -> from, $this -> to);
	}

	protected function doRequest() {
		$ch = curl_init($this->buildRequestUrl());
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
		$output = curl_exec($ch);
		$response = !curl_errno($ch) ? $output : false;
		curl_close($ch);
		return $response;
	}

	public function getRate() {
		return $this -> parseResponse($this -> doRequest());
	}

	public function getProviderId($ucFirst=false) {
		$id = str_replace("CurrencyParser", "", get_class($this));
		return $ucFirst ? $id : strtolower($id);
	}

	abstract protected function parseResponse($response);
}

class GoogleCurrencyParser extends CurrencyParser {
	public $urlPattern = "https://www.google.com/finance/converter?a=1&from=%s&to=%s";

	protected function parseResponse($response) {
		$pattern = "#<span class=bld>(.*?)<\/span>#ui";
		preg_match($pattern, $response, $matches);
		if(!$matches) {
			return false;
		}
		return (float) preg_replace("/[^0-9\.]/", "", $matches[1]);
	}
}

class XeCurrencyParser extends CurrencyParser {
	public $urlPattern = "http://www.xe.com/ucc/convert.cgi?template=mobile&Amount=1&From=%s&To=%s";

	protected function parseResponse($response) {
		$pattern = "#<td class=\"resultColRght\">(.*?)<\/td>#ui";
		preg_match($pattern, $response, $matches);
		if(!$matches) {
			return false;
		}
		return (float) preg_replace("/[^0-9\.]/", "", $matches[1]);
	}
}

function jsonResponse(array $response) {
	header('Content-type: application/json; charset=utf-8');
	$json = json_encode($response);
	$callback = isset($_GET['callback']) ? (string) $_GET['callback'] : null;
	exit($json);
}

$from = isset($_GET['from']) ? substr((string) $_GET['from'], 0, 3) : null;
$to = isset($_GET['to']) ? substr((string) $_GET['to'], 0, 3) : null;

if(in_array(null, array($from, $to))) {
	jsonResponse(array(
		"err"=>"You must specify FROM and TO currencies"
	));
}

$proxy = new DbProxy(new Currency($from, $to));
// Look in cache
if($rate = $proxy->getFromCache()) {
	jsonResponse(array(
		"cache"=>1,
		"from" => $from,
		"to" => $to,
		"rate" => $rate
	));
}

// List of available currency providers
$providers = array(
	"GoogleCurrencyParser", "XeCurrencyParser"
);
shuffle($providers);
foreach($providers as $provider) {
	$currency = new $provider($from, $to);
	if($rate = $currency->getRate()) {
		$proxy->setCache($rate);
		$proxy->saveStat($currency->getProviderId());
		jsonResponse(array(
			"cache" => 0,
			"from" => $from,
			"to" => $to,
			"rate" => $rate
		));
	}
}

jsonResponse(array(
	"err"=>"Server temporary unavailable",
));