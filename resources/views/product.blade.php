@extends("layouts.app")

@section('style')


    <link rel="stylesheet" type="text/css" href="{{asset('css/product_styles.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/product_responsive.css')}}">



<style>
    .actions a,
    .actions form{
        display: inline-block;

    }
    .actions {
        margin-left:80%;
    }
    .c_info{
        background-color:rgba(128,189,255,0.2)  ;

            }
    .c_user{
        font-size: 150%;
    }
    .c_time{
        margin-left: 2%;
    }
    .c_text{
        height :100%;
        padding: 10px;
    }
    .table{
        margin-top:5%;
    }
    .comment_btn{
        margin:0 0 0 90% ;
    }
    .comments{
        background-color: #fff;
        margin-top: 5% ;
        width: 100%;
        padding: 5%;
    }
    .single_product{
        background-color: #f0f0f0;
        border-top :1px solid #ddd;
    }
    .product_description{
        background-color: #fff;
        border: 1px solid #ccc;
        padding: 5%;
        height: 100%;
    }
     .image_list li
     ,.image_selected{
        background-color: #fff;
    }
    .cart_button{
        position: absolute;
        right: -90%;
        margin :-10%  0 0;
    }

    .product_text{
        word-break: break-all;
    }
</style>
@endsection
@section('content')



    <div class="single_product">
        <div class="container">
            <div class="row">


                <div class="col-lg-2 order-lg-1 order-2">
                    <ul class="image_list">

                        @foreach(explode(',',$product->images) as $img)


                            <li data-image="{{asset("../storage/app/products/$product->name/$img")}}"><img src="{{asset("../storage/app/products/$product->name/$img")}}" alt=""></li>
                        @endforeach
                    </ul>
                </div>

                <!-- Selected Image -->
                <div class="col-lg-5 order-lg-2 order-1">
                    <?php  $imgs=explode(',',$product->images);  ?>



                    <div class="image_selected"><img src="{{asset("../storage/app/products/$product->name/$imgs[0]")}}" alt=""></div>
                </div>


                <div class="col-lg-5 order-3">
                    <div class="product_description">
                        <div class="product_category">{{$product->category->name}}</div>
                        <div class="product_name">{{$product->name}}</div>

                        <div class="product_text"><p>{{$product->description}}</p></div>
                        <div class="order_info d-flex flex-row">
                            <form action="../sales" method="post">
                                {{csrf_field()}}
                                <div class="clearfix" style="z-index: 1000;">


                                    <div class="product_quantity clearfix">
                                        <span>Quantity: </span>
                                        <input name="product_id" type="hidden" value="{{$product->id}}">
                                        <input name="price" type="hidden" value="{{$product->price}}">
                                        <input id="quantity_input" name="quantity" type="text" pattern="[0-9]*" value="1"  >
                                        <div class="quantity_buttons">
                                            <div id="quantity_inc_button" class="quantity_inc quantity_control"><i class="fa fa-chevron-up" ></i></div>
                                            <div id="quantity_dec_button" class="quantity_dec quantity_control"><i class="fa fa-chevron-down"></i></div>
                                        </div>
                                    </div>

                                </div>

                                <div class="product_price">{{$product->price}}DA</div>
                                <div class="button_container">
                                    <button type="submit" class="button cart_button">Buy</button>

                                </div>

                            </form>
                        </div>
                    </div>
                </div>

            </div>

            <div class="comments">
                <h3>Comments</h3>
                <form class=" "  @if(isset($comment_e)) action="{{route('avis.update',["id"=>$comment_e->id])}}" @else action="{{route('avis.store')}}" @endif  method="post">
                    {{csrf_field()}}
                    @if(isset($comment_e))   <input type="hidden" name="_method" value="put">@endif
                    <input type="hidden" name="product_id" value="{{$product->id}}">
                    <div class="form-group ">
                        <div class="input-group ">
                            <textarea cols="150" rows="5" name="text"   placeholder="Write your comment"  class="form-control my-2   " required>@if(isset($comment_e)){{$comment_e->text}}@endif</textarea>

                        </div>
                    </div>
                    <button class="btn btn-success comment_btn my-2  my-sm-0 " type="submit">Save</button>
                </form>
                <table class="table table-sm table-responsive-md table-responsive-sm  table-bordered">

                    @foreach($comments as $comment)
                        <tr><td>
                        <div><div class="c_info">
                                <div class="c_user"><b><i class="fa fa-user"></i> {{$comment->user->name}}</b></div>
                                <div class="c_time">time:{{$comment->updated_at}}</div></div>
                            <div class="c_text"> <b>{{$comment->text}}</b></div></div>

                        @auth        @if(Auth::user()->id===$comment->user_id)
                             <div class="actions">   <a class="btn btn-outline-primary  my-2  my-sm-0 " href="{{route('avis.edit',["id"=>$comment->id])}}  " role="button"> Edit</a>

                            <form action="{{route('avis.destroy',["id"=>$comment->id])}} " method="post" >
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="delete">
                                    <input type="hidden" name="product_id" value="{{$comment->product_id}}">
                                    <input class="btn btn-outline-danger  my-2  my-sm-0 " type="submit" value="Delete">
                            </form></div>
                            @endif
                            @endauth
                    </td>
                        </tr>




                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>


@endsection
@section('script')


    <script src="{{asset('js/product_custom.js')}}"></script>


@endsection

