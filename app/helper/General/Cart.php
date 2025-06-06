<?php

namespace App\Helper\General;

class Cart
{
    public $items = [];
    public $totalQty = 0;   // total Quantity
    public $totalPrice = 0;

    public function __construct($oldCart = null)
    {
        if($oldCart) {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        } else {
            $this->items = [];
            $this->totalQty = 0;
            $this->totalPrice = 0;
        }
    }


    // add new item to cart
    public function add($item, $id)
    {
        $image = !empty($item->photo) ? $item->photo : asset('design/style/img/fav.png');
        $price = 0;

        // Product offer
        if ($item->start_offer_at <= date("Y-m-d", time())):
          if (!is_null($item->price_offer)):
            $price = $item->price_offer;
          else:
            $price = $item->price;
          endif;
        else:
          $price = $item->price;
        endif;

        $storedItem = [
            'id' => $id,
            'qty' => 0,
            'price' => $price,
            'item' => $item,
            'photo' => $image
        ];

        // check if this stored item inside the cart is the same item we currently add
        if ( !array_key_exists($id, $this->items) ) {
            $this->items[$id] = $storedItem;
            $this->totalQty += 1;   // increase the qunatity by one every time we add new item to cart
            $this->totalPrice += $price;
        } else {
            $this->totalQty += 1;
            $this->totalPrice += $price;
        }
        $this->items[$id]['qty'] += 1;
    }

    // Remove Item From Cart
    public function remove($id)
    {
        // check if this stored item inside the cart is the same item we currently add
        if ( array_key_exists($id, $this->items ) ) {
            // descrease the quantity of the items inside the cart
            $this->totalQty -= $this->items[$id]['qty'];
            // descrease the total price after delete the price for deleted items
            $this->totalPrice -= $this->items[$id]['qty'] * $this->items[$id]['price'];
            // delete the item it self from the 'items' array (from cart)
            unset($this->items[$id]);
        }
    }

    public function updateQty($id, $qty)
    {
//      dd($this->totalQty, $this->totalPrice, $this->items[$id]['qty'], $this->items[$id]['price'], $qty);
        // remove item quantity from main cart array
        $this->totalQty -= $this->items[$id]['qty'];
        // remove item price from main cart array
        $this->totalPrice -= $this->items[$id]['qty'] * $this->items[$id]['price'];
        // add this new quantity to main array cart
        $this->items[$id]['qty'] = $qty;
        // update items qunatity and price with new value
        $this->totalQty += $qty;
        $this->totalPrice += $qty * $this->items[$id]['price'];
//        dd($this->totalQty, $this->totalPrice);
    }
}
