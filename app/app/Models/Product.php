<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'price', 'stock', 'image'];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'stock' => 'integer',
        ];
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
    // app/Models/Product.php
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // Điểm trung bình
    public function getAverageRatingAttribute(): float
    {
        return round($this->reviews()->avg('rating') ?? 0, 1);
    }
}
