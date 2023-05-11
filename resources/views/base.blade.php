<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> @yield('title') </title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/scss/app.scss'])
  </head>
<body>

  @include('includes.header')

  <div class="container mt-5">
    
    {{-- Ici on récupère la variable SESSION 'success' et on affiche l'alerte si elle existe --}}
    @if(session('success'))
      <div class="alert alert-success">
          {{ session('success') }}
      </div>
    @endif

    @yield('content')

  </div>
</body>
</html>