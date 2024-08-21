@extends('layout')
@section('content')
    <div class="features_items"><!--features_items-->
        <h2 class="title text-center">Tìm kiếm sản phẩm </h2>
        @foreach($search_product as $key=> $product)
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                        <div class="productinfo text-center">
                            <img src=" {{URL::to('public/uploads/product/'.$product->product_image)}}" alt="" />
                            <h5>{{$product->product_name}}</h5>
                            <h2> {{number_format($product->product_price).' '.'VND'}}</h2>
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng </a>
                        </div>
                      
                </div>
               
            </div>
        </div>
        @endforeach
    </div>







@endsection