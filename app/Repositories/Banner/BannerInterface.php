<?php

namespace App\Repositories\Banner;

interface BannerInterface
{
  public function listBanner();
  public function createBanner(array $data);
  public function deleteBanner($id);
}