@extends('base')

@section('title', 'Accueil | RecipeRT ')

@section('content')

    @if($dayRecipe)
        <div class="card w-50 text-bg-light mb-4 mx-auto">
            <img src="{{$dayRecipe->imageUrl()}}" class="img-fluid w-50 mx-auto" alt="Image recette du jour, {{$dayRecipe->name}}">
            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                <div class="card-title"> <strong> Plat du jour </strong> : {{$dayRecipe->name}} </div>
                <a href="{{route('main.show', ['slug' => $dayRecipe->slug,'recipe' => $dayRecipe->id])}}" class="card-text btn btn-primary"> Voir la recette </a>
            </div>
        </div>
    @endif

    <div class="container w-50 d-flex flex-column justify-content-center">
        <div class="row">
            @foreach ($categories as $category)
                <div class="col-2">                        
                    <a href="{{route('main.page.category', ['category' => $category->id, 'categoryname' => Illuminate\Support\Str::lower($category->name)])}}" class="btn btn-primary rounded-circle p-2 d-flex justify-content-center align-items-center" style="width: 75px; height: 75px"> 
                        @if ($category->image)
                            <img src="{{$category->imageUrl()}}" class="w-75" alt="Image de {{$category->name}}"> 
                        @else
                            {{$category->name}}
                        @endif
                    </a>
                </div>
            @endforeach
        </div>
        <a href="{{route('main.page')}}" class="btn btn-primary mx-auto mt-4"> Voir toutes les recettes </a>
    </div>

@endsection