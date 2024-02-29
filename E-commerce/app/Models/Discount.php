<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'amount',
        'validUntil'
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'offer');
    }
    public function categories()
    {
        return $this->hasMany(Category::class, 'offer');
    }

}
