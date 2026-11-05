<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['user_id', 'product_id', 'content', 'created_at'];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
