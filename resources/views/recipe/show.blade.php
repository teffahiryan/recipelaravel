@extends('base')

@section('title')
    Recette : {{$recipe->name}}
@endsection

@section('content')

    <h1> {{$recipe->name}} </h1> 
    <div>
        <p> étapes : {{ $recipe->step }} </p>
        <p> catégorie : {{ $recipe->category->name ?? 'Pas de catégorie' }} </p>
        <p> Plat du jour : {{ $recipe->dayRecipe ?? 'False'}} </p>
    </div>


    <a href="{{route('recipe.index')}}" class="btn btn-primary mt-2"> Retour à la liste </a>

@endsection