@extends('layouts.app')

@section('style')
<style>
    td *{
        display: inline-block;
    }
    section{
        background-color: #eee;
    }
    .table{
        background-color: #fff;
        border: 5px solid #fff;
    }
</style>

    @endsection
@section('content')




    <section class="menu-section clearfix">
        <div class="container">
            <div class="clearfix">

                <div class="float-left">

                    <form  class="form-inline my-2 my-lg-0" @if(isset($category)) action=" ../../category/{{$category->id }}" @else action="category" @endif method="post">
                        {{ csrf_field() }}
                        @if(isset($category))
                        <input type="hidden" name="_method" value="put">
                        @endif
                        <div class="form-group">
                                <div class="input-group my-2 mr-sm-2">
                                    <label for="name"> Category name</label>
                                    <input type="text" name="name" @if(isset($category)) value="{{$category->name}}" @endif id="name"  class="form-control my-2 " required>
                                </div>
                            </div>

                            <button class="btn btn-outline-primary  my-2  my-sm-0 " type="submit">@if(isset($category)) Update @else Add @endif</button>

                        </form>
                    </div>
                </div>
            <table   class="table table-sm table-responsive-md table-responsive-sm  table-striped table-bordered">
            <thead class="table-light">
            <tr>
                <td>Category Name</td>
                <td>Category Products</td>
                <td>Category Sales :DA</td>

            </tr>
            </thead>
            <tbody>
                @foreach($categories as $cat)
                <tr>
                   <td> {{$cat->name}} </td>
                   <td> {{$cat->products->count()}} </td>
                    <td>0</td>
                    <td><a class="btn btn-outline-primary  my-2  my-sm-0 " href="category/{{$cat->id}}/edit" role="button"> Edit</a>
                        <form action="category/{{$cat->id}}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="delete">
                            <input class="btn btn-outline-danger  my-2  my-sm-0 " type="submit" value="Delete">
                        </form></td>
                </tr>

            @endforeach

            </tbody>
            </table>

        </div>
        </section>
    @endsection
@section('script')

    @endsection
