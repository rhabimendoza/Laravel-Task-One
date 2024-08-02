@extends('layout')

@section('content')
    
    <h2 class="title-head p-3">Create a Product</h2>

    <form method="post" action="{{route('addproducts')}}">
        
        @csrf

        <div>
            <label>Name</label>
            <input type="text" name="name"/>
        </div>

        <div>
            <label>Quantity</label>
            <input type="text" name="quantity"/>
        </div>

        <div>
            <label>Price</label>
            <input type="text" name="price"/>
        </div>

        <div>
            <label>Description</label>
            <input type="text" name="description"/>
        </div>

        <div>
            <input type="submit" value="Create Product"/>
        </div>

    </form>
    
@endsection