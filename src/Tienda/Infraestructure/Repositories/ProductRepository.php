<?php

namespace Src\Tienda\Infraestructure\Repositories;

use Src\Tienda\Domain\Entities\Product\Product;
use Src\Tienda\Domain\Entities\Product\ValueObjects\ProductDescription;
use Src\Tienda\Domain\Entities\Product\ValueObjects\ProductId;
use Src\Tienda\Domain\Entities\Product\ValueObjects\ProductName;
use Src\Tienda\Domain\Entities\Product\ValueObjects\ProductPrice;
use Src\Tienda\Domain\Entities\Product\ValueObjects\ProductStock;
use Src\Tienda\Domain\Repositories\ProductRepositoryInterface;
use Src\Tienda\Infraestructure\EloquentModels\EloquentProductModel;

final class ProductRepository implements ProductRepositoryInterface
{
    protected $eloquentUserModel;

    public function __construct()
    {
        $this->eloquentUserModel = new EloquentProductModel();
    }

    public function findById(ProductId $id): ?Product
    {
        $product = $this->eloquentUserModel->find($id->value());
        if ($product) {
            return new Product(
                new ProductId($product->id),
                new ProductName($product->name),
                new ProductDescription($product->description),
                new ProductPrice($product->price),
                new ProductStock($product->stock)
            );
        }
        return null;
    }

    public function save(Product $product): void
    {
        if ($this->eloquentUserModel->find($product->id()->value())) {
            $this->update($product);
        } else {
            $this->create($product);
        }
    }

    public function create(Product $product): void
    {
        $this->eloquentUserModel->create($product->toArray());
    }

    public function update(Product $product): void
    {
        $productModel = $this->eloquentUserModel->find($product->id()->value());
        if ($productModel) {
            $productModel->update([
                'name' => $product->name()->value(),
                'description' => $product->description()->value(),
                'price' => $product->price()->value(),
                'stock' => $product->stock()->value(),
            ]);
        }
    }

    public function delete(ProductId $id): void
    {
        $this->eloquentUserModel
            ->findOrFail($id->value())
            ->delete($id);
    }
}
