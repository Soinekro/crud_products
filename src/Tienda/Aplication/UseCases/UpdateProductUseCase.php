<?php

namespace Src\Tienda\Aplication\UseCases;

use Src\Tienda\Domain\Entities\Product\ValueObjects\ProductDescription;
use Src\Tienda\Domain\Entities\Product\ValueObjects\ProductId;
use Src\Tienda\Domain\Entities\Product\ValueObjects\ProductName;
use Src\Tienda\Domain\Entities\Product\ValueObjects\ProductPrice;
use Src\Tienda\Domain\Entities\Product\ValueObjects\ProductStock;
use Src\Tienda\Domain\Repositories\ProductRepositoryInterface;

final class UpdateProductUseCase
{
    private $repository;

    public function __construct(ProductRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(int $id, string $name, string $description, float $price, int $stock): void
    {
        $product = $this->repository->findById(new ProductId($id));

        $product->updateName(new ProductName($name));
        $product->updateDescription(new ProductDescription($description));
        $product->updatePrice(new ProductPrice($price));
        $product->updateStock(new ProductStock($stock));

        $this->repository->update($product);
    }
}
