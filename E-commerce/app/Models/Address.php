<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        
        'country',
        'province',
        'city',
        'pc',
        'street',
        'number',
        'floor',
        'door',
        'favourite',
        'user_id',
        'dataAddress',
    ];



    public function user(){
        return $this->belongsTo(User::class);
    }
}
