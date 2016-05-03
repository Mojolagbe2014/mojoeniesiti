<?php
namespace nigerianseminars;

class Pay {
	use nigerianseminars\app\payments\Interswitch;
	protected $interswitch;
	public $required = [];

	public function __construct(array $option = array()) {
		foreach ($option as $key => $value) {
			$this->required[$key] = $value;
		}
		$this->interswitch = new Interswitch($required);
	}

	public pay() {
		$response = $this->interswitch->getResponse();
		return $response();
	}	
}


$payment = new Pay(['product_id'=>1234, 'txn_ref']);
echo $payment->required;
