<?php

namespace App\Services;

use App\Repositories\CategoryProductRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CategoryProductService
{
    /**
     * @var CategoryProductRepository
     */
    protected $repository;

    /**
     * @param CategoryProductRepository $categoryProductRepository
     */
    public function __construct(CategoryProductRepository $categoryProductRepository)
    {
        $this->repository = $categoryProductRepository;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll($page,$size,$search)
    {
        return $this->repository->getAllCategory($page,$size,$search);
    }

    /**
     * @param string $identify
     * @return mixed
     */
    public function getOne(string $identify)
    {
        return $this->repository->get($identify);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->repository->create($data);
    }


    /**
     * @param string $identify
     * @param $data
     * @return mixed|void
     */
    public function update(string $identify, $data)
    {
        $totalUpdated = $this->repository->update($identify, $data);

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
        return $this->repository->delete($identify);
    }
}
