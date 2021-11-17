<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    const STATUS = ['製作不可', '製作待ち', '製作中', '製作完了'];

    public function getIsStatusAttribute()
    {
        return $this->status === self::STATUS;
    }
    
    protected $fillable = [
        'order_id',
        'product_id',
        'price',
        'amount',
        'making_status'
    ];

    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
