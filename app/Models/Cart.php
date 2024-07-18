<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_id',
        'price',
        'qty',
        'subtotal',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class,'menu_id','id');
    }
}
