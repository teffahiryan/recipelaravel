<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    // Création de la fonction index retournant une VUE
    public function index (): View {

        // je récupère TOUT les objets Recipe
        $recipes = Recipe::all();

        // retour de la vue INDEX situé dans le dossier RECIPE
        return view('recipe.index', [
            // je passe mes objets dans la VUE
            'recipes' => $recipes
        ]);
    }

    // Fonction SHOW avec comme paramètre le slug et l'id afin de pouvoir les manipuler, retourne une VUE et un objet RECIPE ???
    public function show(string $slug, string $id): View | Recipe {

        // je récupère un objet RECIPE selon l'ID, et s'il ne le trouve pas : erreur 404
        $recipe = \App\Models\Recipe::findOrFail($id);

        // si le slug de l'objet ne correspond pas au slug de la route alors je retourne vers une autre route
        if($recipe->slug != $slug){
            return to_route('recipe.index');
        }

        return view('recipe.show', [
            'recipe' => $recipe
        ]);
    }

}
