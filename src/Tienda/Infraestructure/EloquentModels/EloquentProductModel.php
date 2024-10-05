<?php

namespace Src\Tienda\Infraestructure\EloquentModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed name
 * @property mixed description
 * @property mixed price
 * @property mixed stock
 */
class EloquentProductModel extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = ['name', 'description', 'price', 'stock'];

    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer',
    ];


    public static function factory()
    {
        return new \Src\Tienda\Domain\Factories\EloquentProductModelFactory();
    }
}
