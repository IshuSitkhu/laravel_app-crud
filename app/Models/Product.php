<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
    'name',
    'qty',
    'price',
    'description',
    'user_id',
    'image',
    'status'
];

    //EACH PRODUCT BELONGS TO ONE SELLER
    public function user(){
        return $this->belongsTo(User:: class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}

