<?php

namespace Src\Tienda\Domain\Entities\Product\ValueObjects;

final class ProductPrice
{
    private $value;

    public function __construct(float $price)
    {
        $this->validate($price);
        $this->value = $price;
    }

    public function validate(float $price): void
    {
        if ($price <= 0) {
            throw new \InvalidArgumentException(
                sprintf('<%s> does not allow the value <%s>.', static::class, $price)
            );
        }
    }

    public function value(): float
    {
        return $this->value;
    }
}
