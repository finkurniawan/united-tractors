<?php

namespace App\Repositories;


use App\Models\CategoryProduct;

class CategoryProductRepository extends BaseRepository
{
    public function __construct(private CategoryProduct $categoryProduct){
       parent::__construct($categoryProduct);
    }

    public function getAllCategory($page,$size,$search){
        return $this->categoryProduct->where('name', 'like', '%' . $search . '%')
            ->paginate($size, ['*'], 'page', $page);
    }
}
