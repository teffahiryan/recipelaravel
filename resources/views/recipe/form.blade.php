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
        <label class="form-label" for="preparationTime">Temps de préparation</label>
        <input type="text" class="form-control" name="preparationTime" value="{{ old('preparationTime', $recipe->preparationTime) }}">
        @error('preparationTime')
            {{ $message }}
        @enderror
    </div>

    {{-- ETAPES CKEDITOR5 --}}

    <div class="mb-3">
        <label class="form-label" for="step">Les étapes de préparation</label>
        <textarea id="editor" name="step" class="form-control" >{{ old('step', $recipe->step) }}</textarea>
        @error('step')
            {{ $message }}
        @enderror
    </div>

    {{-- CATEGORY --}}

    <hr>

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

    <hr>

    <div class="mb-3">
        <label class="form-label" for="ingredients"> Liste des ingrédients : </label>
        <table class="table">
            @foreach ($ingredients as $ingredient)
                @php
                    $existIngredient = $recipe->ingredients->where('name', $ingredient->name)->first()
                @endphp 
                @if ($existIngredient)
                    <tr>
                        <td> <input id="ingredient{{$ingredient->id}}" onClick="check({{$ingredient->id}})" type="checkbox" name="ingredients[]" value="{{$ingredient->id}}" checked> </td>
                        <td> {{$ingredient->name}} </td>
                        <td> <input id="quantity{{$ingredient->id}}" type="text" placeholder="Quantité" name="quantity[]" value="{{ old('quantity', $existIngredient->pivot->quantity) }}"> </td>
                        <td> <input id="unit{{$ingredient->id}}" type="text" placeholder="Unité de mesure" name="unit[]" value="{{ old('unit', $existIngredient->pivot->unit) }}"> </td>
                    </tr>
                @else
                    <tr>
                        <td> <input id="ingredient{{$ingredient->id}}" onClick="check({{$ingredient->id}})" type="checkbox" name="ingredients[]" value="{{$ingredient->id}}"> </td>
                        <td> {{$ingredient->name}} </td>
                        <td> <input id="quantity{{$ingredient->id}}" type="text" placeholder="Quantité" name="quantity[]" disabled> </td>
                        <td> <input id="unit{{$ingredient->id}}" type="text" value="" placeholder="Unité de mesure" name="unit[]" disabled> </td>
                    </tr>
                @endif
                @error('ingredients')
                {{ $message }}
                @enderror
                @error('quantity')
                    {{ $message }}
                @enderror
                @error('unit')
                    {{ $message }}
                @enderror
            @endforeach
        </table>
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

    <hr>

    <div class="mb-3">
        <label class="form-label" for="image">Image</label>
        <input type="file" class="form-control" name="image" id="image">
        @if ($recipe->image)
            <img src="{{$recipe->imageUrl()}}" class="rounded mt-2" style="width: 75px; height: 75px; object-fit: cover;" alt="{{$recipe->name}}">
        @endif
        @error('image')
            {{ $message }}
        @enderror
    </div>

    {{-- DAILY RECIPE --}}

    <hr>
    <div class="form-check form-switch mb-3">
        <input type="hidden" value="0" name="dayRecipe">
        <input type="checkbox" class="form-check-input" name="dayRecipe" id="dayRecipe" value="1" @checked(old('dayRecipe', $recipe->dayRecipe ?? false)) >
        <label class="form-check-label" for="dayRecipe">Recette du jour</label>
        @error('dayRecipe')
            {{ $message }}
        @enderror
    </div>

    <div class="my-2">
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

<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ), {
            toolbar: {
                    items: [
                        'heading', '|',
                        'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                        'bulletedList', 'numberedList', 'todoList', '|',
                        'outdent', 'indent', '|',
                        'undo', 'redo',
                        '-',
                        'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                        'alignment', '|',
                        'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                    ],
                    shouldNotGroupWhenFull: true
                },
            language: 'fr'
        })
        .catch( error => {
            console.error( error );
        } );
</script>
