@extends('layouts.app')
@section('style')





<style>
    .product_item {
        border: 1px solid #999;
        display: inline-block;
        width : 32%;
        margin :4px;
    }

    .product_image{
        height:100%;
        width:100%;

    }
    .product_grid {
        padding : 5%;
        position: absolute;
        left:50%;
        transform: translateX(-50%);
        width:80%;
     margin :10px 0;

         }


</style>
@endsection
@section('content')




    <div class="home" style="background: url('{{asset("img/shop_background.jpg")}}') bottom;">

        <div class="home_background parallax-window" data-parallax="scroll" data-image-src="img/shop_background.jpg"></div>
        <div class="home_overlay"></div>
        <div class="home_content d-flex flex-column align-items-center justify-content-center">
            <h2 class="home_title">@if(isset($category_s)){{$category_s->name}}  @else All Categories  @endif  </h2>
        </div>
    </div>

    <!-- Shop Content -->

    <div class="shop_content">


        <div class="product_grid">


            @foreach($products as $product) <a href="{{route('product.index',['id'=>$product->id])}}" tabindex="0">
                <div class="product_item  ">

<?php $imgs=explode(',',$product->images);?>
                    <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{asset("../storage/app/products/$product->name/$imgs[0]")}}" alt=""></div>
                    <div class="product_content">
                        <div class="product_price">{{$product->price}}</div>
                        <div class="product_name"><div>{{$product->name}}</div></div>
                    </div>


    </div></a>
                @endforeach

        </div>
    </div>
@endsection

@section('script')





    @endsection
