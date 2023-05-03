@extends('base')

@section('title')
    Recette : {{$recipe->name}}
@endsection

@section('content')

    <h1> {{$recipe->name}} </h1> 

@endsection