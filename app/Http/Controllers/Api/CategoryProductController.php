<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryProductRequest;
use App\Http\Requests\UpdateCategoryProductRequest;
use App\Http\Resources\CategoryProductResource;
use App\Services\CategoryProductService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class CategoryProductController extends Controller
{
    private CategoryProductService $categoryProductService;

    public function __construct(CategoryProductService $categoryProductService)
    {
        $this->categoryProductService = $categoryProductService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $search = $request->input('search');
        $page = $request->input('page', 1);
        $size = $request->input('size', 10);

       $res = $this->categoryProductService->getAll($page, $size, $search);

       return CategoryProductResource::collection($res);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCategoryProductRequest $request
     * @return CategoryProductResource
     */
    public function store(StoreCategoryProductRequest $request): CategoryProductResource
    {
        $res = $this->categoryProductService->create($request->validated());

        return new CategoryProductResource($res);
    }

    /**
     * Display the specified resource.
     *
     * @param string $categoryProductId
     * @return CategoryProductResource
     */
    public function show(string $categoryProductId)
    {
        $res = $this->categoryProductService->getOne($categoryProductId);

        return new CategoryProductResource($res);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCategoryProductRequest $request
     * @param string $categoryProductId
     * @return CategoryProductResource
     */
    public function update(UpdateCategoryProductRequest $request, string $categoryProductId): CategoryProductResource
    {
        $res = $this->categoryProductService->update($categoryProductId,$request->validated());

        return new CategoryProductResource($res);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $categoryProductId
     * @return Response|Application|ResponseFactory
     */
    public function destroy(string $categoryProductId): \Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {

        try {

         $this->categoryProductService->delete($categoryProductId);
        }catch (\Exception $exception){
            return $this->responseError($exception);
    }

        return \response()->noContent();
    }
}
