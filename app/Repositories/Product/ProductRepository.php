<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Repositories\BaseRepository;

class ProductRepository extends BaseRepository implements ProductInterface
{
    /**
    * @var ModelName
    */
    protected $model;

    public function __construct(Product $model)
    {
      $this->model = $model;
    }

    public function listProduct()
    {
      return $this->model->paginate(10);
    }

    public function createProduct(array $data)
    {
      return $this->model->create($data);
    }

    public function detailProduct($id)
    {
      return $this->model->findOrFail($id);
    }

    public function deleteProduct($id)
    {
      return $this->model->findOrFail($id)->delete();
    }
}