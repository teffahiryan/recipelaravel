@extends('base')

@section('title', 'Accueil recette')

@section('content')

    <div class="container w-50">
        <div class="row">
            @foreach ($categories as $category)
                <div class="col-2">                        
                    <a href="#" class="btn btn-primary rounded-circle p-2 d-flex justify-content-center align-items-center" style="width: 75px; height: 75px"> 
                        <i class="fas fa-hamburger" style="font-size : 2em;"></i> 
                    </a>
                </div>
            @endforeach
        </div>
    </div>

@endsection