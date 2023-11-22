@extends('base')

@section('title', 'Liste des catégories | RecipeRT')

@section('content')

    <h1> Liste des catégories </h1>

    <a href="{{route('category.create')}}" class="btn btn-primary mb-2 text-white"> Créer </a>

    <ul class="list-group"> 
        @foreach ($categories as $category)
            <li class="list-group-item d-flex justify-content-between align-items-center"> 
                <div class="d-flex align-items-center">
                    @if ($category->image)
                        <div class="bg-primary p-2 rounded">
                            <img src="{{$category->imageUrl()}}" alt="Image de {{$category->name}}"> 
                        </div>
                    @endif
                    <p class="ms-2"> {{$category->name}} </p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{route('category.show', ['category' => $category->id])}}" class="btn btn-primary text-white"> Voir </a>
                    <a href="{{route('category.edit', ['category' => $category->id])}}" class="btn btn-primary text-white"> Modifier </a>
                    <form action="{{route('category.delete', ['category' => $category])}}" method="post">
                        @csrf
                        @method("delete")
                        <button class="btn btn-danger">Supprimer</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
    
@endsection