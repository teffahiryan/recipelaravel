{{-- Ici on a créé un formulaire qu'on include dans les vues create et edit pour éviter le DRY --}}
{{-- L'enctypes sert à ce que le fichier soit bien géré --}}
<form action="" method="post" enctype="multipart/form-data">
    {{-- Token laravel à préciser dans tout les formulaires pour le valider et éviter certaines failles --}}
    @csrf
    <div class="mb-3">
        <label class="form-label" for="name">Nom de la recette</label>
        {{-- Le old permet en cas d'erreur d'afficher la dernière valeur saisie, 
        en cas de création d'un objet il n'y aura pas d'ancienne valeur donc on lui passe en default la valeur de l'objet --}}
        <input type="text" class="form-control" name="name" value="{{ old('name', $recipe->name) }}">
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

    {{-- CATEGORY --}}

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

    {{-- INGREDIENT --}}

    <div class="mb-3">
        <label class="form-label" for="ingredients"> Liste des ingrédients : </label>
        <table class="table">
            @foreach ($ingredients as $ingredient)
                <tr>
                    <td> <input id="ingredient{{$ingredient->id}}" onClick="check({{$ingredient->id}})" type="checkbox" name="ingredients[]" value="{{$ingredient->id}}"> </td>
                    <td> {{$ingredient->name}} </td>
                    <td> <input id="quantity{{$ingredient->id}}" type="text" placeholder="Quantité" name="quantity[]" disabled> </td>
                    <td> <input id="unit{{$ingredient->id}}" type="text" placeholder="Unité de mesure" name="unit[]" disabled> </td>
                </tr>
            @endforeach
        </table>
        @error('ingredients')
            {{ $message }}
        @enderror
    </div>

    <script>
        
        function check($id){
            $ingredientCheckBox = document.getElementById("ingredient"+$id);
            $quantityInput = document.getElementById("quantity"+$id);
            $unitInput = document.getElementById("unit"+$id)

            if($ingredientCheckBox.checked == true){
                $quantityInput.disabled = false;
                $unitInput.disabled = false;
            }else{
                $quantityInput.disabled = true;
                $quantityInput.value = null;
                $unitInput.disabled = true;
                $unitInput.value = null;
            }
        }

    </script>
    
    {{-- IMG --}}

    <div class="mb-3">
        <label class="form-label" for="image">Image</label>
        <input type="file" class="form-control" name="image" id="image">
        @error('image')
            {{ $message }}
        @enderror
    </div>

    {{-- DAILY RECIPE --}}

    <div class="form-check mb-3">
        <label class="form-check-label" for="dayRecipe">Recette du jour</label>
        <input type="checkbox" class="form-check-input" name="dayRecipe" id="dayRecipe" value="1">
        @error('dayRecipe')
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