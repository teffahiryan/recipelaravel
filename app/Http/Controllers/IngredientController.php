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

    public function show(Ingredient $ingredient) {

        return view('ingredient.show', [
            'ingredient' => $ingredient
        ]);

    }
 
    public function create() {
        
        return view('ingredient.create');
    }
    
    public function store(FormIngredientRequest $request) {

        $ingredient = Ingredient::create($request->validated());

        return redirect()->route('ingredient.index')->with('success', "L'ingrédient a été créé avec succès");

    }

    public function edit(Ingredient $ingredient) {

        return view('ingredient.edit', [
            'ingredient' => $ingredient
        ]);
        
    }

    public function update(Ingredient $ingredient, FormIngredientRequest $request) {

        $ingredient->update($request->validated());

        return redirect()->route('ingredient.show', ['ingredient' => $ingredient->id])->with('success', "L'ingrédient a bien été modifié");
        
    }

}
