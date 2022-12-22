<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use Faker\Factory as Faker;
use App\Http\Requests\Product\StoreRequest;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    private $product;

    private static $id = null;

    public function setUp(): void
    {
        parent::setUp();
        $this->product = $this->createProduct([
            'title' => 'This is test title',
            'description' => 'This is test description',
            'price' => 100.50,
            'status' => 'Published'
        ]);
    }

    /**
     * Title field of Products is required
     *
     * @test
     */
    public function itCanCheckTitlePriceStatusFieldIsRequired()
    {
        $this->withExceptionHandling();

        $this->postJson(route('product.store'))
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['title','price','status']);
    }
    /**
     * it Can Contain Valid Rule
     *
     * @test
     */
    public function itCanContainValidRule()
    {
        $r = new StoreRequest();

        $this->assertEquals([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric',
            'status' => 'required'
        ], $r->rules());
    }

    /**
     * Create Product
     *
     * @test
     */

    public function itCanCreateProduct()
    {
        $product = Product::factory()->make();
        $data = [
            'title' => $product->title,
            'description' => $product->description,
            'price' => $product->price,
            'status' => $product->status,
        ];
        $response = $this->postJson(route('product.store'), $data)
            ->assertCreated()
            ->json('data');

        $this->assertEquals($product->title, $response['title']);
        $this->assertDatabaseHas('products', ['title' => $product->title]);
    }

    /**
     * List of Products
     *
     * @test
     */
    public function itCanShowProductsList()
    {
        $products = \App\Models\Product::factory(20)->create();

        $response = $this->getJson(route('product.index'))->json('data');

        $this->assertEquals($products->count(), 20);
    }

     /**
     * Single Product
     *
     * @test
     */
    public function itCanShowSingleProduct()
    {
        $product = \App\Models\Product::factory()->create();

        $response = $this->getJson(route('product.show', $product->id))
            ->assertOk()
            ->json('data');

        $this->assertEquals($response['title'], $product->title);
    }

    /**
     * Update Product
     *
     * @test
     */

     public function itCanUpdateProduct()
     {
        $data = [
            'title' => 'updated title',
            'description' => 'updated description',
            'price' => 100.50,
            'status'  => 'Published'
        ];
        $this->withExceptionHandling();
        $this->patchJson(route('product.update', $this->product->id), $data)->assertOk();

        $this->assertDatabaseHas('products', ['id' => $this->product->id, 'title' => 'updated title']);
     }

    /**
     * Delete Product
     *
     * @test
     */
    public function itCanDeleteProduct()
    {
        $product = $this->createProduct();

        $this->deleteJson(route('product.destroy', $product->id))->assertNoContent();

        $this->assertDatabaseHas('products', ['title' => $product->title]);
    }
}
