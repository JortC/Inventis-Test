<?php

class Discount() {

   private double $totalAmount;
   
   public function getTotalAmount() {
      return $this->totalAmount;
   }
   
   public function setTotalAmount($totalAmount) {
      $this->totalAmount = $totalAmount;
   }
   
}
?>