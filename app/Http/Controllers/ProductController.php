<?php

namespace App\Http\Controllers;

use App\Repositories\Product\ProductInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    public $product;

    public function __construct(ProductInterface $productInterface)
    {
        $this->product = $productInterface;
    }

    public function index()
    {
        $products = $this->product->listProduct();
        return view('pages.product.index', compact('products'));
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name'  => 'required',
            'price' => 'required',
            'description'   => '',
            'thumbnail' => 'required|mimes:jpg,jpeg,png'
        ]);

        if ($validate->fails()) {
            Alert::error('Error','Form Not Valid');
            return redirect()->route('product.index');

        }

        $input = $request->all();
        $file = $request->file('thumbnail');
        $fileName = storeImages('public/images/product/',$file);
        $input['thumbnail'] = $fileName;
        $this->product->createProduct($input);
        Alert::success('Success','Product Added Successfully');
        return redirect()->route('product.index');
    }

    public function delete($id)
    {
        $this->product->deleteProduct($id);
        return response()->json([
            'success'   => true,
        ]);
    }
}
