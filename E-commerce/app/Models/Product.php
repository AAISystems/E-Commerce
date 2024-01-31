<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    //Hacemos referencia a los datos que tenemos que pedir al admin para crear producto, con nuestro producto de la BBDD.
    protected $fillable = [
        'id','name', 'description', 'price', 'stock',
    ]; 

    // Tabla pivote con carros
    public function carts()
    {
        return $this->belongsToMany(Cart::class)->withPivot('quantity');
    }
    public function images()
    {
        return $this->hasMany(Images::class);
    }

}
