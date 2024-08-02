@extends('layout')

@section('content')

    <h2 class="title-head p-3">Welcome back, {{Auth::user()->name}}!</h2>

    <div class="main-table p-3">

        <table id="products-table">
            
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{$product->name}}</td>
                        <td>{{$product->quantity}}</td>
                        <td>{{$product->price}}</td>
                        <td>{{$product->description}}</td>
                        <td>
                            <a href="{{route('edit', $product->id)}}" class="btn btn-warning">Edit</a>
                            <form action="{{route('destroy', $product->id)}}" method="post" style="display:inline;">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
        
    </div>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">

    <script>
        $(document).ready(function(){
            $('#products-table').DataTable();
        });
    </script>

@endsection