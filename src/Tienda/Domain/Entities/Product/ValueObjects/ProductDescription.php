<?php

namespace Src\Tienda\Domain\Entities\Product\ValueObjects;


final class ProductDescription
{
    private $value;

    public function __construct(string $description)
    {
        $this->validate($description);
        $this->value = $description;
    }

    public function validate(string $description): void
    {
        if (empty($description)) {
            throw new \InvalidArgumentException(
                sprintf('<%s> does not allow the value <%s>.', static::class, $description)
            );
        }

        if (strlen($description) < 3) {
            throw new \InvalidArgumentException(
                sprintf('<%s> does not allow the value <%s>.', static::class, $description)
            );
        }

        if (strlen($description) > 100) {
            throw new \InvalidArgumentException(
                sprintf('<%s> does not allow the value <%s>.', static::class, $description)
            );
        }
    }

    public function value(): string
    {
        return $this->value;
    }

}
