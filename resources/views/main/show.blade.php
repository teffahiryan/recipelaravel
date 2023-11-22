@extends('base')

@section('title')
    Recette {{$recipe->name}} | RecipeRT
@endsection

@section('content')
    <div class="mx-auto">
        <section class="d-flex flex-column justify-content-center align-items-center mb-5">
            <h1> {{$recipe->name}} </h1>
            <img class="img-fluid rounded w-25" src="{{$recipe->imageUrl()}}" alt="{{$recipe->name}}">
            <p class="badge text-bg-primary p-2 text-white"> <i class="fas fa-hourglass-half text-white"></i> Temps de préparation : {{$recipe->preparationTime}} </p>
        </section>

        <hr class="w-50 mx-auto">

        <section class="d-flex flex-column justify-content-center align-items-center mb-5 w-75 mx-auto">
            <h2 class="mb-4"> Ingrédients </h2>
            <div class="container">
                <div class="row row-cols-3">
                    @foreach ($recipe->ingredients as $ingredient)
                        <div class="col mb-3">
                            <div class="card" style="width: 18rem;">
                                <img src="{{$ingredient->imageUrl()}}" class="card-img mx-auto rounded mt-3" style="width: 75px; height: 75px; object-fit: cover;" alt="Image de l'ingrédient {{$ingredient->name}}">
                                <div class="card-body mx-auto">
                                    <p class="card-text text-center fw-bold"> {{$ingredient->name}} </p>
                                    <p class="card-text text-center"> {{$ingredient->pivot->quantity}} {{$ingredient->pivot->unit}} </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <hr class="w-50 mx-auto">

        <section class="d-flex flex-column mb-5 w-50 mx-auto">
            <h2 class="mb-4 mx-auto"> Préparation </h2>
            <p> {!!$recipe->step!!} </p>
        </section>
    </div>
@endsection