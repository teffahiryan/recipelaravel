@extends('base')

@section('title')
    Recette : {{$recipe->name}}
@endsection

@section('content')

    <h1> {{$recipe->name}} </h1> 
    <p> {{ $recipe->step }} </p>
    <button class="btn btn-primary"> {{$recipe->category->name ?? "null"}} </button>

@endsection