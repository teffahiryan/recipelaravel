<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use App\Http\Requests\FormIngredientRequest;

class IngredientController extends Controller
{
    public function index(): View {

        $ingredients = Ingredient::all();

        return view('ingredient.index', [
            'ingredients' => $ingredients
        ]);

    }

    public function create() {
        
        return view('ingredient.create');
    }
    
    public function store(FormIngredientRequest $request) {

        $ingredient = Ingredient::create($request->validated());

        return redirect()->route('ingredient.index')->with('success', "L'ingrédient a été créé avec succès");

    }
}
