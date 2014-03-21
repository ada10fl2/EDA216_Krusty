<?php

function ifvarset(&$var, $default){
	return isset($var) ? $var : $default;
}

class Pallet {
	public $palletId;
	public $creationDate;
	public $deliveryDate;
	public $state;
	public $productName;
	public $customerName;

	public function isBlocked(){
		return (isset($this->state) && $this->state === "BLOCKED") ? TRUE : FALSE;
	}

	function __construct($result) {
		$this->palletId = ifvarset($result['palletID'], -1);
		$this->creationDate = ifvarset($result['creationDate'], "2000-01-01");
		$this->state = ifvarset($result['currentState'], "unknown");
		$this->productName = ifvarset($result['productName'], "NULL");
		$this->customerName = ifvarset($result['customerName'], "NULL");
		$this->deliveryDate = ifvarset($result['loadingDate'], "");
	}

}
class Ingredient {
	public $ingredientID;
	public $name;
	public $amountInStorage;

	function __construct($tuple) {
		$this->name = ifvarset($tuple["name"],"");
		$this->ingredientID = ifvarset($tuple["ingredientID"],"");
		$this->amountInStorage = ifvarset($tuple["amountInStorage"],"");
	}	
}
?>
