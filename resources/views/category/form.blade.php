<form action="" method="post" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Nom de la catégorie</label>
        <input type="text" class="form-control" name="name" value="{{old('name', $category->name)}}">
        @error('name')
            {{ $message }}
        @enderror

        <div class="mb-3">
            <label class="form-label" for="image">Image</label>
            <input type="file" class="form-control" name="image" id="image">
            @if ($category->image)
                <img src="{{$category->imageUrl()}}" class="rounded mt-2 bg-primary p-2" style="width: 75px; height: 75px; object-fit: cover;" alt="{{$category->name}}">
            @endif
            @error('image')
                {{ $message }}
            @enderror
        </div>
    </div>

    <div class="mt-2">
        <button class="btn btn-primary text-white"> 
            {{-- Si la catégorie contient un ID ça veut dire qu'on modifie sinon on créer --}}
            @if($category->id)
                Modifier
            @else
                Créer
            @endif
        </button>
        <a href="{{route('category.index')}}" class="btn btn-primary text-white"> Retour </a>
    </div>
</form>