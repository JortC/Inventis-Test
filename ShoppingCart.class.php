<?php
include_once('Item.class.php');
include_once('Discount.class.php');

class ShoppingCart {

   private $items = array();
   private $discounts = array();
   
   /**
    * Adds an item to the shopping cart
    * 
    * @param Item $item
    */
   public function addItem(Item $item) {
      $id = $item->getItemId();
      if (!$id) throw new Exception('Item ID not found!');
	  
      // Add or update
      if (isset($this->items[$id])) {
         $this->updateItem($item, $this->items[$item]['qty'] + 1);
      } else {
	 $this->items[$id] = array('item' => $item, 'qty' => 1);
      }
   }
   
   /**
    * Updates the quantity of an item
    * 
    * @param Item $item
    * @param int $qty
    */
   public function updateItem(Item $item, $qty) {
      $this->items[$item]['qty'] = $qty;
   }
   
   /**
    * Returns the total vat amount
    */
   public function getTotalVatAmount() {
      $totalVatAmount = 0;
      foreach( $this->items as $item ) {
         $totalVatAmount += $item['qty'] * $item['item']->getVatAmount();
      }
      return $totalVatAmount;
   }
   
   /**
    * Adds a discount to the shopping cart
    * 
    * @param Discount $discount
    */
   public function addDiscount(Discount $discount) {
      $this->discounts[] = $discount;
   }
   
   /**
    * Returns the total price reduction of all discounts
    */
   public function getTotalDiscount() {
      $totalDiscount = 0;
      foreach( $this->discounts as $discount ) {
         $totalDiscount += $discount->getTotalAmount();
      }
      return $totalDiscount;
   }
   
   /**
    * Returns the subtotal (total amount before resolving discounts and vat)
    */
   public function getSubTotal() {
      $subTotal = 0;
      foreach( $this->items as $item ) {
         $subTotal += $item['qty'] * $item['item']->getPrice();
      }
      return $subTotal;
   }
   
   /**
    * Returns the grand total price after resolving discounts and vat
    */
   public function getTotal() {
      return $this->getSubtotal() - $this->getTotalDiscount() + $this->getTotalVatAmount();
   }

}

?>
