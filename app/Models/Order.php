<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const STATUS = ['入金待ち', '入金確認', '製作中', '発送準備中', '発送済み'];

    public function getIsStatusAttribute()
    {
        return $this->status === self::STATUS;
    }

    protected $fillable = [
        'name',
        'postal_code',
        'address',
        'user_id',
        'shipping_cost',
        'total_payment',
        'payment_method',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function orderDetails()
    {
        return $this->hasMany('App\Models\OrderDetail');
    }
}