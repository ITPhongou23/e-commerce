<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['name', 'phone', 'address', 'description', 'total', 'status'];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}