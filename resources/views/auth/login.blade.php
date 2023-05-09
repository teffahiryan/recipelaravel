@extends('base')

@section('content')
    
    <h1> Se connecter </h1>

    <div class="card">
        <div class="card-body">
            <form action="" method="post" class="vstack gap-3">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}">
                    @error('email')
                        {{ $message }}
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password" value="{{old('password')}}">
                    @error('password')
                        {{ $message }}
                    @enderror
                </div>

                <button class="btn btn-primary mt-3">Se connecter</button>

            </form>
        </div>
    </div>

@endsection