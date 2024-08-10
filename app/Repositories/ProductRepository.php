<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository extends BaseRepository
{
    public function __construct(private Product $product){
        parent::__construct($product);
    }

    public function getAllProduct($page,$size,$search){
        return $this->product->where('name', 'like', '%' . $search . '%')
            ->paginate($size, ['*'], 'page', $page);
    }
}
