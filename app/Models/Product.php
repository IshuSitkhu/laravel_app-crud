<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use Hasfacxtory;

    protected $fillable=[
        'name',
        'qty',
        'price',
        'description'
    ];
}
