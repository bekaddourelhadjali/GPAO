@extends('layouts.app')
@section('style')
<style>
    td:first-child{
        width:30%;
    }
    td:nth-child(3){
        width:30%;
        word-break: break-word;
    }
    .products{
        padding: 2%;
        background-color: #eee;
    }
    .products .btn-primary{
        margin-left: 90%;
    }

    .tab{
        border-collapse:separate ;
        border-spacing:50px ;
        background-color: #fff;
        margin : 0 2% 2%;
        width:90%;
    }
    .tab td{
      width: 30%;
    }
    .table{
        background-color: #fff;
        margin:2%;
        width:96%;
    }

</style>

@endsection
@section('content')
<div class="container">

    <div class="products "><h2>PRODUCTS</h2>
        <form  class=" my-2 my-lg-0" @if(isset($product_e)) action=" ../../products/{{$product_e->id }}" @else action="products" @endif method="post" enctype="multipart/form-data">
            {{csrf_field()}}

            @if(isset($product_e))
                <input type="hidden" name="_method" value="put">
            @endif
            <table class="tab">
                <tr><td> <div class="form_d">

                            <div class="form-group">
                                <label for="designation" class="sr-only">Name</label>
                                <input type="text" id="designation" name="name" @if(isset($product_e)) value="{{$product_e->name}}" @endif placeholder='Name' class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="quantite" class="sr-only">Quantity</label>
                                <input type="number" id="quantite" name="quantity" @if(isset($product_e)) value="{{$product_e->quantity}}" @endif placeholder='Quantity' class="form-control" required>
                            </div>
                            <div class="form-group">
                                <div class="input-group ">
                                    <label for="prix" class="sr-only">Price</label>
                                    <input type="text" id="prix" name="price" @if(isset($product_e)) value="{{$product_e->price}}" @endif placeholder='Price'  class="form-control my-2   " required="">
                                    <div class="input-group-append"><span class="input-group-text my-2 mr-2">DA</span></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group ">
                                    <label for="category_id" >Choose a category</label>
                                    <select name="category_id">
                                        @foreach($categories as $category)

                                            <option value="{{$category->id}}" @if(isset($product_e) &&($product_e->category_id===$category->id) )   selected @endif>{{$category->name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        </div></td>
                    <td>
                        <div class="form_d">
                            <div class="form-group">
                                <div class="input-group ">
                                    <textarea cols="200" rows="5" name="description"   placeholder="Description"  class="form-control my-2   " required>@if(isset($product_e)){{$product_e->description}} @endif</textarea>
                                </div>
                            </div>




                            <div class="form-group">
                                <div class="input-group ">
                                    <input type="file" name="images[]"  @if(isset($product_e)) disabled @endif   multiple="multiple" class="form-control my-2   " required>
                                </div>
                            </div>
                            <button class="btn btn-primary  my-2  my-sm-0 " type="submit">Save</button>
                        </div></td></tr>
            </table>


                        </form>
                    </div>

    <table   class="table table-sm table-responsive-md table-responsive-sm  table-striped table-bordered">
<thead class="table-light">
<td>Images</td>
<td>Name</td>
<td>Description</td>
<td>Price</td>
<td>Quantity</td>
<td>Category</td>
</thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td>




                    @foreach(explode(',',$product->images) as $img)

                        <img src="{{asset("../storage/app/products/$product->name/$img")}}" height="100" width="100" style="display: inline-block">

                        @endforeach
                    </td>
                <td>{{$product->name}}</td>
                <td>{{$product->description}}</td>
                <td>{{$product->price}}</td>
                <td>{{$product->quantity}}</td>
                <td>{{$product->category->name}}</td>
                <td><a class="btn btn-outline-primary  my-2  my-sm-0 " href="products/{{$product->id}}/edit" role="button" style="display: inline-block"> Edit</a>
                    <form style="display: inline-block" action="products/{{$product->id}}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="delete">
                        <input class="btn btn-outline-danger  my-2  my-sm-0 " type="submit" value="Delete">
                    </form></td>
            </tr>

        @endforeach

        </tbody>
    </table>
</div>
@endsection
@section('script')

@endsection

