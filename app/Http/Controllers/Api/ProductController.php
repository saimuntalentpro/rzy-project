<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Product\ProductService;
use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    /**
     * @OA\Get(
     *    path="/product",
     *    operationId="index",
     *    tags={"Product"},
     *    summary="Get list of products",
     *    description="Get list of products",
     *    @OA\Parameter(name="limit", in="query", description="limit", required=false,
     *        @OA\Schema(type="integer")
     *    ),
     *    @OA\Parameter(name="page", in="query", description="the page number", required=false,
     *        @OA\Schema(type="integer")
     *    ),
     *    @OA\Parameter(name="order", in="query", description="order  accepts 'asc' or 'desc'", required=false,
     *        @OA\Schema(type="string")
     *    ),
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example="200"),
     *             @OA\Property(property="data",type="object")
     *          )
     *       )
     *  )
     */
    public function index(Request $request)
    {
        return $this->productService->getAllProducts($request);
    }

    /**
     * @OA\Post(
     *      path="/product",
     *      operationId="store",
     *      tags={"Product"},
     *      summary="Store Product in DB",
     *      description="Store Product in DB",
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"title", "content", "status"},
     *            @OA\Property(property="title", type="string", format="string", example="Test Product Title two"),
     *            @OA\Property(property="price", type="integer", format="integer", example="80.50"),
     *            @OA\Property(property="description", type="string", format="string", example="This is a description for Product two"),
     *            @OA\Property(property="status", type="string", format="string", example="Published"),
     *         ),
     *      ),
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example=""),
     *             @OA\Property(property="data",type="object")
     *          )
     *       )
     *  )
     */
    public function store(StoreRequest $request)
    {
        return $this->productService->storeProduct($request);
    }

    /**
     * @OA\Get(
     *    path="/product/{id}",
     *    operationId="show",
     *    tags={"Product"},
     *    summary="Get Product Detail",
     *    description="Get Product Detail",
     *    @OA\Parameter(name="id", in="path", description="Id of Product", required=true,
     *        @OA\Schema(type="integer")
     *    ),
     *     @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *          @OA\Property(property="status_code", type="integer", example="200"),
     *          @OA\Property(property="data",type="object")
     *           ),
     *        )
     *       )
     *  )
     */
    public function show($id)
    {
        return $this->productService->singleProduct($id);
    }

    /**
     * @OA\Put(
     *     path="/product/{id}",
     *     operationId="update",
     *     tags={"Product"},
     *     summary="Update product in Database",
     *     description="Update product in DB",
     *     @OA\Parameter(name="id", in="path", description="Id of Product", required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(
     *           required={"title", "content", "status"},
     *           @OA\Property(property="title", type="string", format="string", example="Test Product Title three"),
     *            @OA\Property(property="price", type="integer", format="integer", example="90.50"),
     *            @OA\Property(property="description", type="string", format="string", example="This is a description for Product three"),
     *            @OA\Property(property="status", type="string", format="string", example="Published"),
     *        ),
     *     ),
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(property="status_code", type="integer", example="200"),
     *             @OA\Property(property="data",type="object")
     *          )
     *       )
     *  )
     */
    public function update(UpdateRequest $request, $id)
    {
        return $this->productService->productUpdateOrCreate($request, $id);
    }

    /**
     * @OA\Delete(
     *    path="/product/{id}",
     *    operationId="destroy",
     *    tags={"Product"},
     *    summary="Delete Product",
     *    description="Delete Product",
     *    @OA\Parameter(name="id", in="path", description="Id of Product", required=true,
     *        @OA\Schema(type="integer")
     *    ),
     *    @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *         @OA\Property(property="status_code", type="integer", example="200"),
     *         @OA\Property(property="data",type="object")
     *          ),
     *       )
     *      )
     *  )
     */
    public function destroy($id)
    {
        return $this->productService->deleteProduct($id);
    }
}
