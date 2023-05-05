{{-- Ici on a créé un formulaire qu'on include dans les vues create et edit pour éviter le DRY --}}
<form action="" method="post">
    {{-- Token laravel à préciser dans tout les formulaires pour le valider et éviter certaines failles --}}
    @csrf
    <div>
        <label for="name">Nom de la recette</label>
        {{-- Le old permet en cas d'erreur d'afficher la dernière valeur saisie, 
        en cas de création d'un objet il n'y aura pas d'ancienne valeur donc on lui passe en default la valeur de l'objet --}}
        <input type="text" name="name" value="{{ old('title', $recipe->name) }}">
        {{-- Création d'un message d'erreur si l'input n'est pas rempli correctement --}}
        @error('name')
            {{ $message }}
        @enderror
    </div>
    <div>
        <label for="slug">Slug</label>
        <input type="text" name="slug" value="{{ old('slug', $recipe->slug) }}">
        @error('slug')
            {{ $message }}
        @enderror
    </div>
    <div>
        <label for="step">Les étapes de préparation</label>
        <textarea name="step">{{ old('step', $recipe->step) }}</textarea>
        @error('step')
            {{ $message }}
        @enderror
    </div>
    <button class="btn btn-primary"> 
        {{-- Si la recette contient un ID ça veut dire qu'on modifie sinon on créer --}}
        @if($recipe->id)
            Modifier
        @else
            Créer
        @endif
    </button>
</form>