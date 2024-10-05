<?php

namespace Tests\Feature;

use App\Livewire\ProductLivewire;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ProductTest extends TestCase
{
    // use RefreshDatabase;
    // #[Test]
    // public function product_component_exists_on_the_page()
    // {
    //     $this->get('/')
    //         ->assertSeeLivewire(ProductLivewire::class);
    // }

    // #[Test]
    // public function displays_products()
    // {
    //     Product::factory()->create(
    //         [
    //             'name' => 'producto 1',
    //             'description' => 'descripcion 1',
    //             'price' => 10.56,
    //             'stock' => 10,
    //         ]
    //     );

    //     Livewire::test(ProductLivewire::class)
    //         ->assertSee('Por favor cree un registro')
    //         ->call('loadItems')
    //         ->assertSee('producto 1');
    // }

    #[Test]
    public function create_product()
    {
        Livewire::test(ProductLivewire::class)
            ->call('create')
            ->set('name', 'producto 2')
            ->set('description', 'descripcion 2')
            ->set('price', 20.56)
            ->set('stock', rand(0, 100))
            ->call('save')
            ->assertSee('Product Created Successfully');
    }

    #[Test]
    public function update_product()
    {
        $product = Product::create(
            [
                'name' => 'producto 3',
                'description' => 'descripcion 3',
                'price' => 15.54,
                'stock' => rand(0, 100),
            ]
        );

        Livewire::test(ProductLivewire::class)
            ->call('edit', $product->id)
            ->set('name', 'producto 3 editado')
            ->set('description', 'descripcion 3 editado')
            ->set('price', 20.56)
            ->set('stock', 20)
            ->call('save')
            ->assertSee('Product Updated Successfully');
    }

    // #[Test]
    // public function delete_product()
    // {
    //     $product = Product::factory()->create(
    //         [
    //             'name' => 'producto eliminado',
    //             'description' => 'descripcion eliminada',
    //             'price' => 15.54,
    //             'stock' => rand(0, 100),
    //         ]
    //     );

    //     Livewire::test(ProductLivewire::class)
    //         ->call('delete', $product->id)
    //         ->assertSee('Product Deleted Successfully');
    // }

    // #[Test]
    // public function search_product()
    // {
    //     Product::factory()->create(
    //         [
    //             'name' => 'producto 1',
    //             'description' => 'descripcion 1',
    //             'price' => 10.56,
    //             'stock' => 10,
    //         ]
    //     );
    //     Product::factory()->create(
    //         [
    //             'name' => 'producto 2',
    //             'description' => 'descripcion 2',
    //             'price' => 20.56,
    //             'stock' => 20,
    //         ]
    //     );
    //     Product::factory()->create(
    //         [
    //             'name' => 'producto 3',
    //             'description' => 'descripcion 3',
    //             'price' => 30.56,
    //             'stock' => 30,
    //         ]
    //     );

    //     Livewire::test(ProductLivewire::class)
    //         ->set('search', 'producto 1')
    //         ->call('loadItems')
    //         ->assertSee('producto 1')
    //         ->assertDontSee('producto 3')
    //         ->assertDontSee('producto 2');
    // }

    // #[Test]
    // public function show_product()
    // {
    //     $product = Product::create(
    //         [
    //             'name' => 'producto 1',
    //             'description' => 'descripcion 1',
    //             'price' => 20.56,
    //             'stock' => 20,
    //         ]
    //     );
    //     Livewire::test(ProductLivewire::class)
    //         ->call('show', $product->id)
    //         ->assertSee('producto 1')
    //         ->assertSee('descripcion 1')
    //         ->assertSee(20.56)
    //         ->assertSee(20);
    // }
    // #[Test]
    // public function required_fields()
    // {
    //     Livewire::test(ProductLivewire::class)
    //         ->call('save')
    //         ->assertHasErrors(['name' => 'required', 'description' => 'required', 'price' => 'required', 'stock' => 'required']);
    // }
}
