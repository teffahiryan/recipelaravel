@extends('base')

@section('content')

    <h1> Mes recettes </h1>

    @dump($recipes)

    @foreach ($recipes as $recipe)
        <article>
            <h2> {{$recipe->name}} </h2>
            <a href="{{ route('recipe.show', ['slug' => $recipe->slug, 'id' => $recipe->id]) }}" class="btn"> Accéder à la recette </a>
        </article>
    @endforeach

@endsection