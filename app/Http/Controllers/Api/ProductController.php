<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Services\ProductService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ProductController extends Controller
{

    public function __construct(private ProductService $productService){}

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $search = $request->input('search');
        $page = $request->input('page', 1);
        $size = $request->input('size', 10);

        $res = $this->productService->getAll($page,$size,$search);

        return ProductResource::collection($res);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProductRequest $request
     * @return ProductResource
     */
    public function store(StoreProductRequest $request): ProductResource
    {
        $validated = $request->validated();
        $filename = uniqid(). '.' . $validated['image']->getClientOriginalExtension();

        $path = $request->file('image')->storeAs(
                'images', $filename
            );

        $validated['image'] = $path;

        $res = $this->productService->create($validated);

        return new ProductResource($res);
    }

    /**
     * Display the specified resource.
     *
     * @param string $categoryProductId
     * @return ProductResource
     */
    public function show(string $categoryProductId): ProductResource
    {
        $res = $this->productService->getOne($categoryProductId);

        return new ProductResource($res);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductRequest $request
     * @param string $categoryProductId
     * @return ProductResource
     */
    public function update(UpdateProductRequest $request, string $categoryProductId): ProductResource
    {
        $validated = $request->validated();

        $filename = uniqid(). '.' . $validated['image']->getClientOriginalExtension();

        $path = $request->file('image')->storeAs(
            'images', $filename
        );

        $validated['image'] = $path;

        $res = $this->productService->update($categoryProductId,$validated);

        return new ProductResource($res);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $categoryProductId
     * @return Response|Application|ResponseFactory
     */
    public function destroy(string $categoryProductId): \Illuminate\Http\Response|Application|ResponseFactory
    {

        try {

            $this->productService->delete($categoryProductId);
        }catch (\Exception $exception){
            return $this->responseError($exception);
        }

        return $this->responseSuccess();
    }
}
