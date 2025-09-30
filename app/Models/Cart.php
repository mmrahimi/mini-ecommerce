<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $guarded = [];

    public function scopeBySession()
    {
        return $this->where('session_id', session()->getId())->latest();
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withTimestamps();
    }

    public function total()
    {
        return $this->products()->sum('price');
    }

    public function scopeForCurrentUser($query)
    {
        if (auth()->check()) {
            return $query->where('user_id', auth()->id());
        }

        return $query->where('session_id', session()->getId());
    }
}
