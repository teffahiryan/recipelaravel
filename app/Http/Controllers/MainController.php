<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class MainController extends Controller
{
    public function index(): View {

        $categories = Category::all();

        $dayRecipe = Recipe::where('dayRecipe', '1')->first();

        return view('main.index', [
            'categories' => $categories,
            'dayRecipe' => $dayRecipe
        ]);

    }

    public function show(string $slug, Recipe $recipe): RedirectResponse | View {

        if($recipe->slug != $slug){
            return to_route('main.page');
        }

        return view('main.show', [
            'recipe' => $recipe
        ]);
    }

    public function page(Category $category): View {

        if($category->name != ''){
            $recipes = Category::find($category->id)->recipes()->paginate(3);
            $title = $category->name;
        }else{
            $recipes = Recipe::paginate(3);
            $title = "";
        }

        return view('main.page', [
            'recipes' => $recipes,
            'title' => $title
        ]);

    }


}
