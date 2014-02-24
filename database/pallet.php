<?php
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
}
?>
