<?php

namespace Src\Tienda\Domain\Entities\Product\ValueObjects;

final class ProductName
{
    private $value;

    public function __construct(string $name)
    {
        $this->validate($name);
        $this->value = $name;
    }

    public function validate(string $name): void
    {
        if (empty($name)) {
            throw new \InvalidArgumentException(
                sprintf('<%s> does not allow the value <%s>.', static::class, $name)
            );
        }

        if (strlen($name) < 3) {
            throw new \InvalidArgumentException(
                sprintf('<%s> does not allow the value <%s>.', static::class, $name)
            );
        }

        if (strlen($name) > 50) {
            throw new \InvalidArgumentException(
                sprintf('<%s> does not allow the value <%s>.', static::class, $name)
            );
        }
    }

    public function value(): string
    {
        return $this->value;
    }

}
