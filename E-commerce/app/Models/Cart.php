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
        'user_id',
        

    ];

    // Funcion tabla pivote con productos
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
        
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

  

}
