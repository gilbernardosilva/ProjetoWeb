<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type', 'category', 'price', 'description','image'];


    public function cart() {
        return $this->belongsTo(Cart::class, 'cart_id', 'id' );
    }
}
