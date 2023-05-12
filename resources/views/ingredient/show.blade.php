@extends('base')

@section('title')
    Ingrédient : {{$ingredient->name}}
@endsection

@section('content')

    <h1> {{$ingredient->name}} </h1> 
    <p> {{ $ingredient->img }} </p>

    <a href="{{route('ingredient.index')}}" class="btn btn-primary mt-2"> Retour à la liste </a>

@endsection