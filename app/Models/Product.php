<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function genre()
    {
        return $this->belongsTo('App\Models\Genre');
    }

    public function cart_items()
    {
        return $this->hasMany('App\Models\CartItem');
    }

    public function orderDetails()
    {
        return $this->hasMany('App\Models\OrderDetail');
    }
}
