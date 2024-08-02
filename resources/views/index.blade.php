@extends('layout')

@section('content')
    <h2 class="index-head p-3">Welcome, back {{Auth::user()->name}}</h2>
@endsection