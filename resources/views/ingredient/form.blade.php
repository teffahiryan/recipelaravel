<form action="" method="post">
    @csrf
    <div>
        <label for="name">Nom de l'ingrédient</label>
        <input type="text" name="name">

        @error('name')
            {{ $message }}
        @enderror
    </div>

    <div>
        <label for="img">Image de l'ingrédient</label>
        <input type="text" name="img">

        @error('img')
            {{ $message }}
        @enderror
    </div>

    <button class="btn btn-primary"> Créer </button>
</form>