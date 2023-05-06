<form action="" method="post">
    @csrf
    <div>
        <label for="name">Nom de la catégorie</label>
        <input type="text" name="name">

        @error('name')
            {{ $message }}
        @enderror
    </div>

    <button class="btn btn-primary"> Créer </button>
</form>