<?php 
namespace nigerianseminars\app\payments;
class Interswitch {
	
	protected $product_id;
	protected $txn_ref;
	protected $amount;
	protected $mackey = "D3D1D05AFE42AD50818167EAC73C109168A0F108F32645C8B59E897FA930DA44F9230910DAC9E20641823799A107A02068F7BC0F4CC41D2952E249552255710F";
	protected $url = "https://stageserv.interswitchng.com/test_paydirect/api/v1/gettransaction.json";
	

	public function __construct (array $options = array()){
		foreach($option as $key => $value) {
			if(property_exists($this, $key)){
				$this->$key = $value;
			}
		}
	}

	protected function hash() {
		$unsave_hash = $this->product_id.$this->txn_ref.$this->mackey;
		$save = hash("sha512", $unsave_hash, false);
		return $save;
	}

	protected function makeHeader() {
		$save_hash = $this->hash();
		$header_info = [
			"method" => "GET",
			"header" => "UserAgent: Mozilla/4.0 (compatible; MSIE 6.0; MS Web Services Client Protocol 4.0.30319.239)\r\n" .
      "Hash:$save_hash\r\n",
      "protocol_version" => "1.1"
		];
		return $header_info;
	}
	
	protected function setCurl() {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->url);
		$header_info = $this->makeHeader();
		curl_setopt($ch, CURLOPT_HEADER, $header_info);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		return $ch;
	}
	
	public function getResponse() {
		$ch = $this->setCurl();
		$response = curl_exec($ch);
		curl_close($ch);
		if($response === false) {
			 $info = curl_getinfo($curl);
    		curl_close($ch);
			$info .= 'error occured';
			return $info;
		}else {
			return $response;
		}
	}
}