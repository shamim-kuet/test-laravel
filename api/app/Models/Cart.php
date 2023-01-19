<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart
{
    public $items;
    public $totalQty = 0;
    public $totalPrice = 0;
    public $totalItems = 0;

    public function __construct($oldCart)
    {
        if ($oldCart) {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
            $this->totalItems = $oldCart->totalItems;
        }
    }

    public function cartUpdates($id, $gifts)
    {
        $this->items[$id]['gifts'] = 3;
    }
    public function add($item, $qty, $price, $shippingcost, $id)
    {
        $storedItem = array('qty'=> 0,'price'=> $price,'item'=> $item);
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $storedItem = $this->items[$id];
            }
        }

        //$storedItem['qty']++;
        $storedItem['qty']+=$qty;
        //$storedItem['qty'] ++;

        //$storedItem['price'] = $price * $storedItem['qty'];
        $this->items[$id] = $storedItem;
        $this->totalQty += $qty;
        //$this->totalQty ++;
        $this->totalItems = count($storedItem);
        $this->totalPrice += $price * $qty;
    }


    public function reduceByOne($id, $price)
    {
        //dd($price);
        $this->items[$id]['qty']--;
        //$this->items[$id]['price'] -= $price;
        $this->totalQty--;
        $this->totalPrice -= $price;

        if ($this->items[$id]['qty'] <= 0) {
            unset($this->items[$id]);
        }
    }


    public function removeItem($id)
    {
        $this->totalQty -= $this->items[$id]['qty'];
        $this->totalPrice -= $this->items[$id]['price'];
        unset($this->items[$id]);
    }
}
