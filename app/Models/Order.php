<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function total()
    {
        return $this->products()->sum('price');
    }
}
