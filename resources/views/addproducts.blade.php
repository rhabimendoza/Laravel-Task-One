@extends('layout')

@section('content')
    
    <h2 class="title-head p-3">Create a product</h2>

    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{Session::get('success')}}
        </div>
    @endif

    @if(Session::has('error'))
        <div class="alert alert-danger" role="alert">
            {{Session::get('error')}}
        </div>
    @endif

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