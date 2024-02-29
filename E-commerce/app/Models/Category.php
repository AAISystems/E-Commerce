<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

   
    //Hacemos referencia a los datos que tenemos que pedir al admin para crear producto, con nuestro producto de la BBDD.
    protected $fillable = [
        'id','name','show'
        
    ]; 

    // Tabla pivote con carros
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
    
    public function discount()
    {
        return $this->belongsTo(Discount::class, 'offer');
    }

    
    
    


}