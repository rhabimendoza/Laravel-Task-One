@extends('layout')

@section('content')
    
    <h2 class="title-head p-3">Edit a Product</h2>

    <form method="post" action="{{route('update', ['id' => $product->id])}}">
        
        @csrf

        <div>
            <label>Name</label>
            <input type="text" name="name" value="{{$product->name}}"/>
        </div>

        <div>
            <label>Quantity</label>
            <input type="text" name="quantity" value="{{$product->quantity}}"/>
        </div>

        <div>
            <label>Price</label>
            <input type="text" name="price" value="{{$product->price}}"/>
        </div>

        <div>
            <label>Description</label>
            <input type="text" name="description" value="{{$product->description}}"/>
        </div>

        <div>
            <input type="submit" value="Update Product"/>
        </div>

    </form>

@endsection