<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'sellerName',
        'sellerNIF',
        'sellerAddress',
        'date',
        'userName',
        'userNIF',
        'userAddress',
        'total'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }


    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }
}
