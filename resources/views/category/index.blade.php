@extends('base')

@section('content')

    <h1> Liste des catégories : </h1>

    <ul class="list-group"> 
        @foreach ($categories as $category)
            <li class="list-group-item"> {{$category->name}} </li>
        @endforeach
    </ul>
    
@endsection