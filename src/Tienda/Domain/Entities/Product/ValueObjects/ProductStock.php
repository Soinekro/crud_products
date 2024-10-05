<?php

namespace Src\Tienda\Domain\Entities\Product\ValueObjects;


final class ProductStock
{
    private $value;

    public function __construct(int $stock)
    {
        $this->validate($stock);
        $this->value = $stock;
    }

    public function validate(int $stock): void
    {
        if ($stock < 0) {
            throw new \InvalidArgumentException(
                sprintf('<%s> does not allow the value <%s>.', static::class, $stock)
            );
        }
    }

    public function value(): int
    {
        return $this->value;
    }

}
