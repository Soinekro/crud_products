<?php

namespace Src\Tienda\Domain\Entities\Product;

use Src\Tienda\Domain\Entities\Product\ValueObjects\ProductDescription;
use Src\Tienda\Domain\Entities\Product\ValueObjects\ProductId;
use Src\Tienda\Domain\Entities\Product\ValueObjects\ProductName;
use Src\Tienda\Domain\Entities\Product\ValueObjects\ProductPrice;
use Src\Tienda\Domain\Entities\Product\ValueObjects\ProductStock;

final class Product
{
    private $id, $name, $description, $price, $stock;

    public function __construct(
        ?ProductId $id,
        ProductName $name,
        ProductDescription $description,
        ProductPrice $price,
        ProductStock $stock
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->stock = $stock;
    }

    public function id(): ProductId
    {
        return $this->id;
    }

    public function name(): ProductName
    {
        return $this->name;
    }

    public function description(): ProductDescription
    {
        return $this->description;
    }

    public function price(): ProductPrice
    {
        return $this->price;
    }

    public function stock(): ProductStock
    {
        return $this->stock;
    }

    public function updateName(ProductName $name): void
    {
        $this->name = $name;
    }

    public function updateDescription(ProductDescription $description): void
    {
        $this->description = $description;
    }

    public function updatePrice(ProductPrice $price): void
    {
        $this->price = $price;
    }

    public function updateStock(ProductStock $stock): void
    {
        $this->stock = $stock;
    }

    public function toArray(): array
    {
        return array(
            'id' => $this->id->value(),
            'name' => $this->name->value(),
            'description' => $this->description->value(),
            'price' => $this->price->value(),
            'stock' => $this->stock->value()
        );
    }

    public function __toString(): string
    {
        return json_encode($this->toArray());
    }
}
