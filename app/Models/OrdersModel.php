<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdersModel extends Model
{
    use HasFactory;

    protected $table = 'order';

    protected $fillable = [
        'title',
        'price',
        'amount',
        'address'
    ];
}
