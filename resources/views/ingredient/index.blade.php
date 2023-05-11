@extends('base')

@section('content')

    <h1> Liste des ingrédients </h1>

    <a href="{{route('ingredient.create')}}" class="btn btn-primary mb-2"> Créer </a>

    <ul class="list-group"> 
        @foreach ($ingredients as $ingredient)
            <li class="list-group-item d-flex justify-content-between align-items-center"> 
                <div> {{$ingredient->name}} </div>
                <div>
                    <a href="#" class="btn btn-primary"> Voir </a>
                    <a href="#" class="btn btn-primary"> Modifier </a>
                    <a href="#" class="btn btn-danger"> Supprimer </a>
                </div>
            </li>
        @endforeach
    </ul>
    
@endsection