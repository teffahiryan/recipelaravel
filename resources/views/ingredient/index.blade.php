@extends('base')

@section('content')

    <h1> Liste des ingrédients </h1>

    <a href="{{route('ingredient.create')}}" class="btn btn-primary mb-2"> Créer </a>

    <ul class="list-group"> 
        @foreach ($ingredients as $ingredient)
            <li class="list-group-item d-flex justify-content-between align-items-center"> 
                <div> {{$ingredient->name}} </div>
                <div class="d-flex gap-2">
                    <a href="{{route('ingredient.show', ['ingredient' => $ingredient->id])}}" class="btn btn-primary"> Voir </a>
                    <a href="{{route('ingredient.edit', ['ingredient' => $ingredient->id])}}" class="btn btn-primary"> Modifier </a>
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