<form action="" method="post">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Nom de la catégorie</label>
        <input type="text" class="form-control" name="name">

        @error('name')
            {{ $message }}
        @enderror
    </div>

    <button class="btn btn-primary"> Créer </button>
</form>