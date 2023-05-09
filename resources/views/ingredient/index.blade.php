@extends('base')

@section('content')

    <h1> Liste des ingrédients : </h1>

    <ul class="list-group"> 
        @foreach ($ingredients as $ingredient)
            <li class="list-group-item"> {{$ingredient->name}} </li>
        @endforeach
    </ul>

    <a href="{{route('ingredient.create')}}" class="btn btn-primary mt-2"> Créer </a>
    
@endsection