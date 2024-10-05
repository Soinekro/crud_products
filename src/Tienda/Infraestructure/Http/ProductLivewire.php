<?php

namespace Src\Tienda\Infraestructure\Http;

use Livewire\Component;
use Livewire\WithPagination;
use Src\Tienda\Aplication\UseCases\CreateProductUseCase;
use Src\Tienda\Aplication\UseCases\DeleteProductUseCase;
use Src\Tienda\Aplication\UseCases\ReadProductUseCase;
use Src\Tienda\Aplication\UseCases\UpdateProductUseCase;
use Src\Tienda\Domain\Entities\Product\ValueObjects\ProductId;
use Src\Tienda\Infraestructure\EloquentModels\EloquentProductModel;
use Src\Tienda\Infraestructure\Repositories\ProductRepository;

class ProductLivewire extends Component
{
    public $readyToLoad = false;
    public $name, $description, $price, $stock;
    public $id_product;

    public $showModal = false;
    public $showModalProduct = false;

    public $search;
    public $perPage = 5;

    use WithPagination;

    public function loadItems()
    {
        $this->readyToLoad = true;
    }

    public function render()
    {
        $products = $this->readyToLoad ? $this->loadProducts() : collect();
        return view('livewire.product-livewire', compact('products'))
            ->layout('layouts.app');
    }

    public function updatedPerPage()
    {
        $this->resetPage();
    }

    public function loadProducts()
    {
        return EloquentProductModel::when($this->search, function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('description', 'like', '%' . $this->search . '%');
        })->orderBy('id', 'desc')
            ->paginate($this->perPage);
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->description = '';
        $this->price = '';
        $this->stock = '';
        $this->id_product = '';
    }

    public function save()
    {
        $this->validate($this->rules(), $this->messages());

        $message = ($this->id_product) ? 'Product Updated Successfully.' : 'Product Created Successfully.';
        if ($this->id_product) {
            $this->update(new UpdateProductUseCase(new ProductRepository()));
        } else {
            $this->store(new CreateProductUseCase(new ProductRepository()));
        }
        session()->flash('message', $message);

        $this->resetInputFields();
        $this->closeModal();
    }

    public function store(CreateProductUseCase $createProductUseCase)
    {
        $createProductUseCase->__invoke(
            $this->name,
            $this->description,
            $this->price,
            $this->stock
        );
    }

    public function update(UpdateProductUseCase $updateProductUseCase)
    {
        $updateProductUseCase->__invoke(
            $this->id_product,
            $this->name,
            $this->description,
            $this->price,
            $this->stock
        );
    }
    public function edit($id)
    {
        $this->resetInputFields();
        $this->show(new ReadProductUseCase(new ProductRepository()), $id);
        $this->closeModalProduct();
        $this->openModal();
    }

    public function delete(DeleteProductUseCase $deleteProductUseCase, $id)
    {
        $deleteProductUseCase->__invoke(new ProductId($id));
        session()->flash('message', 'Product Deleted Successfully.');
    }

    public function show(ReadProductUseCase $showProductUseCase, $id)
    {
        $product = $showProductUseCase->__invoke(new ProductId($id));
        $this->name = $product->name()->value();
        $this->description = $product->description()->value();
        $this->price = $product->price()->value();
        $this->stock = $product->stock()->value();
        $this->id_product = $product->id()->value();
        $this->openModalProduct();
    }

    public function openModalProduct()
    {
        $this->showModalProduct = true;
    }

    public function closeModalProduct()
    {
        $this->showModalProduct = false;
    }

    public function close()
    {
        $this->closeModal();
        $this->closeModalProduct();
    }

    private function rules()
    {
        return [
            'name' => 'required|unique:products,name,' . $this->id_product,
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|int|min:0',
        ];
    }

    private function messages()
    {
        return [
            'name.required' => 'El campo nombre es requerido.',
            'name.unique' => 'El campo nombre ya ha sido tomado.',
            'description.required' => 'El campo descripción es requerido.',
            'price.required' => 'El campo precio es requerido.',
            'price.numeric' => 'El campo precio debe ser un número.',
            'price.min' => 'El campo precio debe ser mayor o igual a 0.',
            'stock.required' => 'El campo stock es requerido.',
            'stock.int' => 'El campo stock debe ser un número entero.',
            'stock.min' => 'El campo stock debe ser mayor o igual a 0.',
        ];
    }
}
