<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function calculateRating()
    {
        return round($this->reviews()->avg('rating'), 1);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
}
