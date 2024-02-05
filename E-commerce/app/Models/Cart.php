<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'total_products',
        'users_id',
        // 'products_id',
        'carts_orders_id'

    ];

    // Funcion tabla pivote con productos
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }

}
