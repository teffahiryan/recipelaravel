<form action="" method="post">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Nom de l'ingrédient</label>
        <input type="text" class="form-control" name="name">

        @error('name')
            {{ $message }}
        @enderror
    </div>

    <div class="mb-3">
        <label for="img" class="form-label">Image de l'ingrédient</label>
        <input type="text" class="form-control" name="img">

        @error('img')
            {{ $message }}
        @enderror
    </div>

    <button class="btn btn-primary"> Créer </button>
</form>