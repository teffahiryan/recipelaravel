@extends('base')

@section('title', 'Liste des ingrédients | RecipeRT')

@section('content')

    <h1> Liste des ingrédients </h1>

    <a href="{{route('ingredient.create')}}" class="btn btn-primary mb-2 text-white"> Créer </a>

    <ul class="list-group"> 
        @foreach ($ingredients as $ingredient)
            <li class="list-group-item d-flex justify-content-between align-items-center"> 
                <div class="d-flex align-items-center">
                    @if ($ingredient->img)
                        <div class="bg-light p-2 rounded">
                            <img src="{{$ingredient->imageUrl()}}" alt="Image de {{$ingredient->name}}"> 
                        </div>
                    @endif
                    <p class="ms-2"> {{$ingredient->name}} </p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{route('ingredient.show', ['ingredient' => $ingredient->id])}}" class="btn btn-primary text-white"> Voir </a>
                    <a href="{{route('ingredient.edit', ['ingredient' => $ingredient->id])}}" class="btn btn-primary text-white"> Modifier </a>
                    <form action="{{route('ingredient.delete', ['ingredient' => $ingredient])}}" method="post">
                        @csrf
                        @method("delete")
                        <button class="btn btn-danger">Supprimer</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>

@endsection