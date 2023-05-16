@extends('base')

@section('title', 'Voir un ingrédient | RecipeRT')

@section('title')
    Catégorie : {{$category->name}}
@endsection

@section('content')

    <h1> {{$category->name}} </h1> 

    <a href="{{route('category.index')}}" class="btn btn-primary mt-2"> Retour à la liste </a>

@endsection