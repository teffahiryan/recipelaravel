@extends('base')

@section('title')
    Recette {{$recipe->name}} | RecipeRT
@endsection

@section('content')
    <h1> {{$recipe->name}} </h1>
@endsection