<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> @yield('title') </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="{{ route('index') }}">Accueil</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                {{-- @class permet d'insérer les classes dans le premier paramètre et dans le second d'entrer une classe selon une condition --}}
                <a @class(['nav-link', 'active' => request()->route()->getName() === 'recipe.index']) aria-current="page" href="{{route('recipe.index')}}"> Recettes </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('recipe.create') }}">Créer sa recette</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Test</a>
              </li>
            </ul>

            <div class="navbar-nav ms-auto mb-2 mb-lg-0">
              {{-- @auth permet de vérifier si l'utilisateur est connecté --}}
              @auth
                {{ \Illuminate\Support\Facades\Auth::user()->name }}
                {{-- Méthode conseillé pour le bouton logout via formulaire --}}
                <form class="nav-item" action="{{route('auth.logout')}}" method="post">
                  {{-- simulation de méthode delete voir le fichier web route --}}
                  @method("delete")
                  @csrf
                  <button class="nav-link"> Se déconnecter </button>
                </form>
              @endauth

              {{-- S'il n'est pas connecté alors il est un invité @guest qu'on invite a se connecter --}}
              @guest
                <a href="{{route('auth.login')}}"> Se connecter </a>
              @endguest
            </div>

          </div>
        </div>
    </nav>

    <div class="container mt-5">

      {{-- Ici on récupère la variable SESSION 'success' et on affiche l'alerte si elle existe --}}
      @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
      @endif

      @yield('content')
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>