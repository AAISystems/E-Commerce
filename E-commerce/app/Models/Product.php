<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'id','name', 'description', 'price', 'stock',
    ]; 

    // Tabla pivote con carros
    public function carts()
    {
        return $this->belongsToMany(Cart::class)->withPivot('quantity');
    }

}
