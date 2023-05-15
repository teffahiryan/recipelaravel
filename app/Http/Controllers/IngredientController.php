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
 
    public function create(Ingredient $ingredient) {
        
        $ingredient = new Ingredient();

        return view('ingredient.create', [
            'ingredient' => $ingredient
        ]);
    }
    
    public function store(FormIngredientRequest $request) {

        $ingredient = Ingredient::create($request->validated());

        /** @var UploadedFile|null $img */
        $img = $request->validated('img');
        if ($img != null && !$img->getError()){
            $data['img'] = $img->store('ingredient', 'public');
            $ingredient->update($data);
        }

        return redirect()->route('ingredient.index')->with('success', "L'ingrédient a été créé avec succès");

    }

    public function edit(Ingredient $ingredient) {

        return view('ingredient.edit', [
            'ingredient' => $ingredient
        ]);
        
    }

    public function update(Ingredient $ingredient, FormIngredientRequest $request) {

        $ingredient->update($request->validated());

        /** @var UploadedFile|null $img */
        $img = $request->validated('img');
        if ($img != null && !$img->getError()){
            $data['img'] = $img->store('ingredient', 'public');
            $ingredient->update($data);
        }

        return redirect()->route('ingredient.show', ['ingredient' => $ingredient->id])->with('success', "L'ingrédient a bien été modifié");
         
    }

    public function delete(Ingredient $ingredient){

        $ingredient->delete();

        return redirect()->route('ingredient.index')->with('success', "L'ingrédient a bien été supprimé");

    }


}
