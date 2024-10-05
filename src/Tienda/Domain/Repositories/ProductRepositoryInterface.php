<?php

namespace Src\Tienda\Domain\Repositories;

use Src\Tienda\Domain\Entities\Product\Product;
use Src\Tienda\Domain\Entities\Product\ValueObjects\ProductId;

/**
 * @property Product[] $products
 */
interface ProductRepositoryInterface
{
    public function findById(ProductId $id): ?Product;
    public function save(Product $product): void;
    public function create(Product $product): void;
    public function update(Product $product): void;
    public function delete(ProductId $id): void;
}
