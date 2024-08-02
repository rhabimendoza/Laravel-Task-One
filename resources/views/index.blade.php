@extends('layout')

@section('content')

    <h2 class="title-head p-3">Welcome back, {{Auth::user()->name}}!</h2>

    <div>

        <table border="1">

            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Description</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>

            @foreach ($products as $product)
                <tr>
                    <td>{{$product->id}}</td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->quantity}}</td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->description}}</td>
                    <td>
                        <a href="" >Edit</a>
                    </td>
                    <td>
                        <a href="" >Delete</a>
                    </td>
                </tr>
            @endforeach

        </table>

    </div>
    
@endsection