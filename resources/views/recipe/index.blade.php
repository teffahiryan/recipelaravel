@extends('base')

@section('title', 'Liste des recettes')

@section('content')

    <h1> Mes recettes </h1>

    @foreach ($recipes as $recipe)
        <article>
            <h2> {{$recipe->name}} </h2>
            @if ($recipe->image)
                <img src="{{$recipe->imageUrl()}}" alt=""> 
            @endif
            <a href="{{ route('recipe.show', ['slug' => $recipe->slug, 'recipe' => $recipe->id]) }}" class="btn btn-primary"> Accéder à la recette </a>
        </article>
    @endforeach

@endsection