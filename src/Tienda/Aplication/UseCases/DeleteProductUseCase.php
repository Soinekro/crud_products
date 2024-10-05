<?php

namespace Src\Tienda\Aplication\UseCases;

use Src\Tienda\Domain\Entities\Product\ValueObjects\ProductId;
use Src\Tienda\Domain\Repositories\ProductRepositoryInterface;

final class DeleteProductUseCase
{
    private $repository;

    public function __construct(ProductRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(ProductId $id): void
    {
        $this->repository->delete($id);
    }
}
