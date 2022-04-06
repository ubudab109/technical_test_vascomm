<?php

namespace App\Repositories\Banner;

use App\Models\Banner;
use App\Repositories\BaseRepository;

class BannerRepository extends BaseRepository implements BannerInterface
{
    /**
    * @var ModelName
    */
    protected $model;

    public function __construct(Banner $model)
    {
      $this->model = $model;
    }

    public function listBanner()
    {
      return $this->model->paginate(5);
    }

    public function createBanner(array $data)
    {
      return $this->model->create($data);
    }

    public function deleteBanner($id)
    {
      return $this->model->findOrFail($id)->delete();
    }

    
}