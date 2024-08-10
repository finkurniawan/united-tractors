<?php

namespace App\Services;

use App\Repositories\CategoryProductRepository;
use App\Repositories\ProductRepository;

class ProductService
{
    public function __construct(private ProductRepository $productRepository){}

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll($page,$size,$search)
    {
        return $this->productRepository->getAllProduct($page,$size,$search);
    }

    /**
     * @param string $identify
     * @return mixed
     */
    public function getOne(string $identify)
    {
        return $this->productRepository->get($identify);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->productRepository->create($data);
    }


    /**
     * @param string $identify
     * @param $data
     * @return mixed|void
     */
    public function update(string $identify, $data)
    {
        $totalUpdated = $this->productRepository->update($identify, $data);

        if (!$totalUpdated) {
            return null;
        }

        return $this->getOne($identify);
    }

    /**
     * @param string $identify
     * @return mixed
     */
    public function delete(string $identify): mixed
    {
        return $this->productRepository->delete($identify);
    }
}
