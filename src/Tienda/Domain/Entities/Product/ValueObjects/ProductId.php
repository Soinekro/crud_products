<?php

namespace Src\Tienda\Domain\Entities\Product\ValueObjects;

final class ProductId
{
    private $value;

    public function __construct(?int $id)
    {
        if ($id !== null) {
            $this->validate($id);
        }
        $this->value = $id;
    }

    public function validate(int $id): void
    {
        $options = array(
            'options' => array(
                'min_range' => 1
            )
        );
        if (!filter_var($id, FILTER_VALIDATE_INT, $options)) {
            throw new \InvalidArgumentException(
                sprintf('<%s> does not allow the value <%s>.', static::class, $id)
            );
        }
    }

    public function value(): ?int
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return (string) $this->value;
    }
}
