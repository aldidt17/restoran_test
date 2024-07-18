<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'return',
        'pay',
        'total_price'
    ];

    public function detail(){
        return $this->hasMany(DetailTransaction::class,'transaction_id','id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
