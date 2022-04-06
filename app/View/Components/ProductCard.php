<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ProductCard extends Component
{

    public $productName, $img, $desc, $price;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($productName, $img, $desc, $price)
    {
        $this->productName = $productName;
        $this->img = $img;
        $this->desc = $desc;
        $this->price = $price;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.product-card');
    }
}
