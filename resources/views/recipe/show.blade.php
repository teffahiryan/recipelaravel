@extends('base')

@section('title')
    Recette : {{$recipe->name}}
@endsection

@section('content')

    <h1> {{$recipe->name}} </h1> 
    <div>
        <p> catégorie : {{ $recipe->category->name ?? 'Pas de catégorie' }} </p>
        <p> Plat du jour : {{ $recipe->dayRecipe ?? 'False'}} </p>
        <p> Temps de préparation : {{ $recipe->preparationTime }} </p>
        <p> étapes : {!! $recipe->step !!} </p>
        <ul>
            @foreach ($recipe->ingredients as $ingredient)
                <li> {{$ingredient->name}} | {{$ingredient->pivot->quantity}} {{$ingredient->pivot->unit}} </li>
            @endforeach
        </ul>
    </div>


    <a href="{{route('recipe.index')}}" class="btn btn-primary mt-2"> Retour à la liste </a>

@endsection