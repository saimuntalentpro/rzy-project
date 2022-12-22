<?php

namespace App\Services\Product;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Traits\RespondsWithHttpStatus;
use App\Http\Resources\ProductResource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ProductService
{
    use RespondsWithHttpStatus;

    protected $model;

    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    public function getAllProducts($request) : JsonResponse
    {
        try {
            $limit = $request->limit ?: 15;
            $order = $request->order == 'asc' ? 'asc' : 'desc';

            $products = $this->model->where('status', 'Published')->paginate($limit);
            $productResource = ProductResource::collection($products)->response()->getData(false);

            return $this->success(
                "Product has been shown!",
                $productResource,
                Response::HTTP_OK
            );

        } catch (\Exception $e) {
            return $this->failure(
                'Something is wrong! Please try again later!',
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
    }

    public function storeProduct($request) : JsonResponse
    {
        try {
            DB::beginTransaction();

            $product = $this->model->create($request->only('title', 'price','description', 'status'));
            DB::commit();
            $productResource = new ProductResource($product);
            return response()
            ->json([
                'data' =>  $productResource,
                'message' => 'Product has been created successfully!'
            ], Response::HTTP_CREATED);
            // return $this->success(
            //     "Product has been created successfully!",
            //     $productResource,
            //     Response::HTTP_CREATED
            // );
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->failure(
                'Something is wrong! Please try again later!',
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
    }

    public function singleProduct($id) : JsonResponse
    {
        try {
            $product = $this->model->findOrFail($id);
            $productResource = new ProductResource($product);

            return $this->success(
                "Single Product has been shown!",
                $productResource,
                Response::HTTP_OK
            );
        } catch (\Exception $e) {
            return $this->failure(
                'Something is wrong! Please try again later!',
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
    }

    public function productUpdateOrCreate($request, $id) : JsonResponse
    {
        try {
            DB::beginTransaction();

            $product = $this->model->updateOrCreate(['id' => $id], $request->only('title', 'price', 'description', 'status'));
            DB::commit();
            $productResource = new ProductResource($product);

            return $this->success(
                "Product has been updated successfully!",
                $productResource,
                Response::HTTP_OK
            );
        } catch (\Exception $e) {
            DB::rollback();
            return $this->failure(
                'Something is wrong! Please try again later!',
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
    }

    public function deleteProduct($id) : JsonResponse
    {
        try {
            $this->model->find($id)->delete();
            $data = null;
            return $this->success(
                "Product has been deleted successfully!",
                $data,
                Response::HTTP_NO_CONTENT
            );
        } catch (\Exception $e) {
            return $this->failure(
                'Something is wrong! Please try again later!',
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
    }
}
