@extends('layouts.main')

@section('content')
<div class="row pb-5 mb-4 mt-5">
    @if (count($products) > 0)
        
        @foreach ($products as $product)
            <x-product-card img="{{asset('storage/images/product/'.$product->thumbnail)}}" productName="{{$product->name}}" desc="{{$product->description}}" price="{{$product->price}}" />
        @endforeach
        <div class="d-flex flex-wrap">
            {{$products->links()}}
        </div>
    @else
    <x-product-card img="https://bootstrapious.com/i/snippets/sn-cards/shoes-3_rk25rt.jpg" productName="sepatu" desc="teawfdsfasdfdasfs" price="20000" />

    @endif
</div>
@endsection