{{-- Ici on a créé un formulaire qu'on include dans les vues create et edit pour éviter le DRY --}}
{{-- L'enctypes sert à ce que le fichier soit bien géré --}}
<form action="" method="post" enctype="multipart/form-data">
    {{-- Token laravel à préciser dans tout les formulaires pour le valider et éviter certaines failles --}}
    @csrf
    <div class="mb-3">
        <label class="form-label" for="name">Nom de la recette</label>
        {{-- Le old permet en cas d'erreur d'afficher la dernière valeur saisie, 
        en cas de création d'un objet il n'y aura pas d'ancienne valeur donc on lui passe en default la valeur de l'objet --}}
        <input type="text" class="form-control" name="name" value="{{ old('title', $recipe->name) }}">
        {{-- Création d'un message d'erreur si l'input n'est pas rempli correctement --}}
        @error('name')
            {{ $message }}
        @enderror
    </div>
    <div class="mb-3">
        <label class="form-label" for="slug">Slug</label>
        <input type="text" class="form-control" name="slug" value="{{ old('slug', $recipe->slug) }}">
        @error('slug')
            {{ $message }}
        @enderror
    </div>
    <div class="mb-3">
        <label class="form-label" for="step">Les étapes de préparation</label>
        <textarea name="step" class="form-control" >{{ old('step', $recipe->step) }}</textarea>
        @error('step')
            {{ $message }}
        @enderror
    </div>
    <div class="mb-3">
        <label class="form-label" for="category">Choix de la catégorie</label>
        <select class="form-control" id="category" name="category_id">
            <option value=""> Sélectionner une catégorie </option>
            @foreach ($categories as $category)
                <option @selected(old('category_id', $recipe->category_id) == $category->id) value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        @error('category_id')
            {{ $message }}
        @enderror
    </div>

    <hr>
    <h2> Liste des ingrédients : </h2>
    <hr>

    <div class="mb-3">
        <label class="form-label" for="image">Image</label>
        <input type="file" class="form-control" name="image" id="image">
        @error('image')
            {{ $message }}
        @enderror
    </div>

    <div class="mt-2">
        <button class="btn btn-primary"> 
            {{-- Si la recette contient un ID ça veut dire qu'on modifie sinon on créer --}}
            @if($recipe->id)
                Modifier
            @else
                Créer
            @endif
        </button>
        <a href="{{route('recipe.index')}}" class="btn btn-primary"> Retour </a>
    </div>
</form>