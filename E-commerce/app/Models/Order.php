<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'total',
        'users_id',
        'invoices_id',
        'cart_id',
        'dataAddress'
    ];


     // Funcion tabla pivote con productos
     public function products()
     {
         return $this->belongsToMany(Product::class)->withPivot('quantity');
     }

     public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoices_id');
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
}
