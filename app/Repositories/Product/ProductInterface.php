<?php

namespace App\Repositories\Product;

interface ProductInterface
{
    public function listProduct();
    public function createProduct(array $data);
    public function detailProduct($id);
    public function deleteProduct($id);
}