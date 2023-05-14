@extends('base')

@section('title')
    @if($title != null)
        {{$title}}s 
    @else
        Toutes les recettes
    @endif 
    | RecipeRT
@endsection

@section('content')
    
    <h1 class="w-75 mx-auto mb-4"> 
        @if($title != null)
            {{$title}}s 
        @else
            Toutes les recettes
        @endif
    </h1>

    @foreach ($recipes as $recipe)
        <div class="card w-75 mb-3 mx-auto">
            <div class="row g-0">
                @if ($recipe->image)
                    <div class="col-md-2">
                        <img class="img-fluid rounded-start" src="{{$recipe->imageUrl()}}" alt="{{$recipe->name}}"> 
                    </div>
                @endif
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{$recipe->name}}</h5>
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        <p class="card-text"> {{$recipe->category->name ?? 'Pas de catégorie'}} </p>
                        <a href="{{route('main.show', ['slug' => $recipe->slug, 'recipe' => $recipe->id])}}" class="card-button btn btn-primary mt-2"> Accéder à la recette </a>
                    </div>
                </div>
            </div>
      </div>
    @endforeach

    {{ $recipes->links('pagination::simple-bootstrap-5') }}

@endsection