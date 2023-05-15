<form action="" method="post" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Nom de l'ingrédient</label>
        <input type="text" class="form-control" name="name" value="{{ old('name', $ingredient->name) }}">

        @error('name')
            {{ $message }}
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label" for="img">Image</label>
        <input type="file" class="form-control" name="img" id="img">
        @if ($ingredient->img)
            <img src="{{$ingredient->imageUrl()}}" class="rounded mt-2" style="width: 75px; height: 75px; object-fit: cover;" alt="{{$ingredient->name}}">
        @endif
        @error('img')
            {{ $message }}
        @enderror
    </div>

    
   

    <div class="mt-2">
        <button class="btn btn-primary"> 
            @if($ingredient->id)
                Modifier
            @else
                Créer
            @endif
        </button>
        <a href="{{route('ingredient.index')}}" class="btn btn-primary"> Retour </a>
    </div>
</form>