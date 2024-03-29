<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Recipe;
use App\Models\Category;
use Illuminate\View\View;
use App\Models\Ingredient;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\FormRecipeRequest;


class RecipeController extends Controller
{
    // Création de la fonction index retournant une VUE
    public function index (): View {

        // je récupère TOUT les objets Recipe
        $recipes = Recipe::all();

        // User::create([
        //     'name' => 'John',
        //     'email' => 'john@doe.fr',
        //     'password' => Hash::make('0000')
        // ]);

        // retour de la vue INDEX situé dans le dossier RECIPE
        return view('recipe.index', [
            // je passe mes objets dans la VUE
            'recipes' => $recipes
        ]);
    }
 
    // Fonction SHOW avec comme paramètre le slug et l'objet RECIPE donné directement à la place de l'ID
    public function show(string $slug, Recipe $recipe): RedirectResponse | View {

        // je récupère un objet RECIPE selon l'ID, et s'il ne le trouve pas : erreur 404
        // /!\ Plus nécessaire car on récupère directement l'objet via le paramètre Recipe.
        // $recipe = \App\Models\Recipe::findOrFail($recipe);

        // si le slug de l'objet ne correspond pas au slug de la route alors je retourne vers une autre route
        if($recipe->slug != $slug){
            return to_route('recipe.index');
        }

        return view('recipe.show', [
            'recipe' => $recipe
        ]);
    }

    // Fonction CREATE qui sera la vue
    public function create() {
        // On créer un nouvel objet RECIPE vide pour ne pas avoir de soucis avec le form.blade.php (valeur par défaut insérer de l'objet recipe en cas de EDIT - voir le fichier)
        $recipe = new Recipe();
        $categories = Category::all();
        $ingredients = Ingredient::all();

        return view('recipe.create', [
            // On lui retourne l'objet vide
            'recipe' => $recipe,
            'categories' => $categories,
            'ingredients' => $ingredients
        ]);

    }

    // Fonction STORE, toujours dans la création qui cette fois va "STORER" l'objet et redirect vers une autre vue
    public function store(FormRecipeRequest $request) {
        
        // On créer et on store cette objet s'il est validé par un fichier Request (app->requets->formreciperequest.php) qui se créer à l'aide de la commande "php artisan make:request NomDeLaRequest"
        $recipe = Recipe::create($request->validated());

        if($request->ingredients != null){
            for($i = 0; $i <= count($request->ingredients) - 1 ; $i++){
                $ingredient_id_array[$request->ingredients[$i]] = ['quantity' => $request->quantity[$i], 'unit' => $request->unit[$i]];
            }
            $recipe->ingredients()->sync($ingredient_id_array); 
        }

        /** @var UploadedFile|null $image */
        $image = $request->validated('image');
        if ($image != null && !$image->getError()){
            $data['image'] = $image->store('recipe', 'public');
            $recipe->update($data);
        }

        // Une fois l'objet sauvegardé on retourne vers une route, ici vers le show, on lui passe à l'aide du with une variable SESSION pour afficher un message de succès -> voir le fichier blade base
        return redirect()->route('recipe.show', ['slug' => $recipe->slug, 'recipe' => $recipe->id])->with('success', "La recette a bien été sauvegardé");
    }

    // Fonction EDIT, le fonctionnement est très similaire au create seulement on va a chaque fois récupérer l'objet Recipe déjà passé dans l'url
    // Ici l'objet recipe va servir a remplir les inputs dans le formulaire
    public function edit(Recipe $recipe) {

        $categories = Category::all();
        $ingredients = Ingredient::all();

        return view('recipe.edit', [
            'recipe' => $recipe,
            'categories' => $categories,
            'ingredients' => $ingredients
        ]);

    }
 
    public function update(Recipe $recipe, FormRecipeRequest $request){

        // $ingredients = [];

        // $recipe->update($request->validated());

        // for($i = 0; $i <= count($request->ingredients) - 1 ; $i++){
        //     array_push($ingredients, ['ingredient_id' => $request->ingredients[$i], 'quantity' => $request->quantity[$i], 'unit' => $request->unit[$i]]);
        // }

        // $recipe->ingredients()->sync($ingredients);        

        $recipe->update($request->validated());

        if($request->ingredients != null){
            for($i = 0; $i <= count($request->ingredients) - 1 ; $i++){
                $ingredient_id_array[$request->ingredients[$i]] = ['quantity' => $request->quantity[$i], 'unit' => $request->unit[$i]];
            }

            $recipe->ingredients()->sync($ingredient_id_array); 
        }

        // Ne pas oublier le lien symbolique "php artisan storage:link"
        /** @var UploadedFile|null $image */
        $image = $request->validated('image');
        if ($image != null && !$image->getError()){
            $data['image'] = $image->store('recipe', 'public');
            $recipe->update($data);
        }

        return redirect()->route('recipe.show', ['slug' => $recipe->slug, 'recipe' => $recipe->id])->with('success', "La recette a bien été modifié");

    }

    public function delete(Recipe $recipe){

        $recipe->delete();

        return redirect()->route('recipe.index')->with('success', "La recette a bien été supprimé");

    }

}
