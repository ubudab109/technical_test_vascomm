<?php

namespace App\Http\Controllers;

use App\Repositories\Banner\BannerInterface;
use App\Repositories\Product\ProductInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public $product, $banner;

    public function __construct(ProductInterface $productInterface, BannerInterface $bannerInterface)
    {
        $this->product = $productInterface;
        $this->banner = $bannerInterface;
    }
    
    public function index()
    {
        $banners = $this->banner->listBanner();
        $products = $this->product->listProduct();
        return view('welcome',compact('banners','products'));
    }
}
