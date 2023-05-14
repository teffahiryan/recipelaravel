@extends('base')

@section('title', 'Liste des recettes')

@section('content')

    <h1> Liste des recettes </h1>

    <a href="{{route('recipe.create')}}" class="btn btn-primary mb-2"> Créer </a>

    <ul class="list-group">
        @foreach ($recipes as $recipe)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    @if ($recipe->image)
                        <img src="{{$recipe->imageUrl()}}" alt=""> 
                    @endif
                    <p class="ms-2"> {{$recipe->name}} </p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('recipe.show', ['slug' => $recipe->slug, 'recipe' => $recipe->id]) }}" class="btn btn-primary"> Voir </a>
                    <a href="{{ route('recipe.edit', ['recipe' => $recipe->id]) }}" class="btn btn-primary"> Modifier </a>
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