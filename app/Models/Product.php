<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed name
 * @property mixed description
 * @property mixed price
 * @property mixed stock
 */
class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'stock'];

    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer',
    ];


}
