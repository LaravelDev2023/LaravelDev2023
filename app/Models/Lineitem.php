<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lineitem extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $table = 'lineitems';

    protected $fillable = [
        'user_id',
        'order_id',
        'product_id',
        'quantity',
        'price',
        'total_price',
    ];
}
