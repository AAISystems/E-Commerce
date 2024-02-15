<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

   
    //Hacemos referencia a los datos que tenemos que pedir al admin para crear producto, con nuestro producto de la BBDD.
    protected $fillable = [
        'id','name', 'description', 'price', 'stock','show'
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
    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('quantity');
    }

    public function invoices()
    {
        return $this->belongsToMany(Invoice::class)->withPivot('quantity');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
   
    public function wishlist()
    {
        return $this->belongsToMany(Wishlist::class);
    }
    



}
