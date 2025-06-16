<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = ['product_id', 'batch_id', 'quantity'];

    // Each inventory record belongs to one product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
