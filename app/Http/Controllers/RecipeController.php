<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    
    public function index (): View {
        $recipes = Recipe::all();
        return view('recipe.index', [
            'recipes' => $recipes
        ]);
    }

    public function show(string $slug, string $id): View | Recipe {

        $recipe = \App\Models\Recipe::findOrFail($id);

        if($recipe->slug != $slug){
            return to_route('recipe.index');
        }

        return view('recipe.show', [
            'recipe' => $recipe
        ]);
    }

}
