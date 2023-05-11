@extends('base')

@section('content')

    <h1> Liste des catégories </h1>

    <a href="{{route('category.create')}}" class="btn btn-primary mb-2"> Créer </a>

    <ul class="list-group"> 
        @foreach ($categories as $category)
            <li class="list-group-item d-flex justify-content-between align-items-center"> 
                <div> {{$category->name}} </div>
                <div>
                    <a href="#" class="btn btn-primary"> Voir </a>
                    <a href="#" class="btn btn-primary"> Modifier </a>
                    <a href="#" class="btn btn-danger"> Supprimer </a>
                </div>
            </li>
        @endforeach
    </ul>
    
@endsection