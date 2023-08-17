<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'sub_total',
        'shipping',
        'tax_amount',
        'tax_rate',
        'amount',
        'comment',
        'status',
    ];
}
