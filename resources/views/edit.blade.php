@extends('layout')

@section('content')
    
    <div class="container">

        <h2 class="title-head p-3">Edit a Product</h2>

        <form method="post" action="{{route('update', ['id' => $product->id])}}">
            
            @csrf

            <div class="form-group m-3">
                <label>Name</label>
                <input type="text" class="form-control" name="name" value="{{$product->name}}"/>
            </div>

            <div class="form-group m-3">
                <label>Quantity</label>
                <input type="text" class="form-control" name="quantity" value="{{$product->quantity}}"/>
            </div>

            <div class="form-group m-3">
                <label>Price</label>
                <input type="text" class="form-control" name="price" value="{{$product->price}}"/>
            </div>

            <div class="form-group m-3">
                <label>Description</label>
                <input type="text" class="form-control" name="description" value="{{$product->description}}"/>
            </div>

            <div>
                <input type="submit" class="btn-create m-3 p-2" value="Update Product"/>
            </div>

        </form>
    
    </div>

@endsection