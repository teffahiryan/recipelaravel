@extends('base')

@section('title', 'Liste des recettes')

@section('content')

    <h1> Liste des recettes </h1>

    <a href="{{route('recipe.create')}}" class="btn btn-primary mb-2 text-white"> Créer </a>

    <ul class="list-group">
        @foreach ($recipes as $recipe)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    @if ($recipe->image)
                        <img src="{{$recipe->imageUrl()}}" alt=""> 
                    @endif
                    <p class="mx-2"> {{$recipe->name}} </p>
                    @if ($recipe->dayRecipe == 1)
                        <div class="badge text-bg-success"> Recette du jour </div>
                    @endif
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('recipe.show', ['slug' => $recipe->slug, 'recipe' => $recipe->id]) }}" class="btn btn-primary text-white"> Voir </a>
                    <a href="{{ route('recipe.edit', ['recipe' => $recipe->id]) }}" class="btn btn-primary text-white"> Modifier </a>
                    <form action="{{route('recipe.delete', ['recipe' => $recipe])}}" method="post">
                        @csrf
                        @method("delete")
                        <button class="btn btn-danger">Supprimer</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
 
@endsection