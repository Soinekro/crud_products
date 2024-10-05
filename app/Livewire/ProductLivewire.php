<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Src\Tienda\Aplication\UseCases\CreateProductUseCase;
use Src\Tienda\Aplication\UseCases\UpdateProductUseCase;
use Src\Tienda\Infraestructure\Repositories\ProductRepository;

class ProductLivewire extends Component
{
    public $readyToLoad = false;
    public $name, $description, $price, $stock;
    public $id_product;

    public $showModal = false;
    public $showModalProduct = false;
    public $search;

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

    public function loadProducts()
    {
        return Product::when($this->search, function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
        })->orderBy('id', 'desc')
          ->paginate(10);
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

        if ($this->id_product) {
            $this->update(new UpdateProductUseCase(new ProductRepository()));
        } else {
            $this->store(new CreateProductUseCase(new ProductRepository()));
        }
        session()->flash('message', $this->id_product ? 'Product Updated Successfully.' : 'Product Created Successfully.');

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
        session()->flash('message', 'Product Created Successfully.');
        $this->resetInputFields();
        $this->closeModal();
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
        session()->flash('message', 'Product Updated Successfully.');
        $this->resetInputFields();
        $this->closeModal();
    }
    public function edit(Product $product)
    {
        $this->resetInputFields();
        $this->show($product);
        $this->closeModalProduct();
        $this->openModal();
    }

    public function delete(Product $product)
    {
        $product->delete();
        session()->flash('message', 'Product Deleted Successfully.');
    }

    public function show(Product $product)
    {
        $this->name = $product->name;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->stock = $product->stock;
        $this->id_product = $product->id;
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
