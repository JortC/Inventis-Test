<?php

class Item {

   private $itemId;
   private $price;
   private $vat; //BTW-percentage
   
   public function getItemId() {
      return $this->itemId;
   }
   public function setItemId($itemId) {
      $this->itemId = $itemId;
   }
   public function getPrice() {
      return $this->price;
   }
   public function setPrice($price) {
      $this->price = $price;
   }
   public function getVat() {
      return $this->vat;
   }
   public function setVat($vat) {
      $this->vat = $vat;
   }
   
   /**
    * Returns the total amount of taxes to be paid for this item
	*/
   public function getVatAmount() {
      return $this->price / 100 * $this->vat;
   }
   
   /**
    * Returns the total price of the item including taxes
	*/
   public function getPriceInclVat() {
      return $this->price + $this->getVatAmount();
   }
   
}
?>