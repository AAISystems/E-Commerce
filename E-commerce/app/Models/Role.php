<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


//Creo el modelo rol con los atributos a rellenar que tiene la tabla
class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'rol'
    ]; 
}
