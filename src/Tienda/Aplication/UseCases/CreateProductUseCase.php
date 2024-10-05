<?php

namespace Src\Tienda\Aplication\UseCases;

use Src\Tienda\Domain\Entities\Product\Product;
use Src\Tienda\Domain\Entities\Product\ValueObjects\ProductDescription;
use Src\Tienda\Domain\Entities\Product\ValueObjects\ProductId;
use Src\Tienda\Domain\Entities\Product\ValueObjects\ProductName;
use Src\Tienda\Domain\Entities\Product\ValueObjects\ProductPrice;
use Src\Tienda\Domain\Entities\Product\ValueObjects\ProductStock;
use Src\Tienda\Domain\Repositories\ProductRepositoryInterface;

final class CreateProductUseCase
{
    private $repository;

    public function __construct(ProductRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $name, string $description, float $price, int $stock): void
    {
        $product = new Product(
            new ProductId(null),
            new ProductName($name),
            new ProductDescription($description),
            new ProductPrice($price),
            new ProductStock($stock)
        );
        $this->repository->save($product);
    }
}
