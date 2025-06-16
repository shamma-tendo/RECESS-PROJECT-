<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'type', 'description', 'price', 'created_at'];

    // Each product has one inventory record
    public function inventory()
    {
        return $this->hasOne(Inventory::class);
    }

    // Optional: if you want to see all orders for a product
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}

