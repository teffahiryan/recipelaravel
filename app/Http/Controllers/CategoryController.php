<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormCategorieRequest;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    
    public function index(): View {

        $categories = Category::all();

        return view('category.index', [
            'categories' => $categories
        ]);

    }

    public function show(Category $category): View {

        return view('category.show', [
            'category' => $category
        ]);

    }

    public function create() {

        $category = new Category();
        
        return view('category.create', [
            'category' => $category
        ]);
    }
    
    public function store(FormCategorieRequest $request) {

        $category = Category::create($request->validated());

        return redirect()->route('category.index')->with('success', "La catégorie a été créé avec succès");

    }

    public function edit(Category $category) {

        return view('category.edit', [
            'category' => $category
        ]);

    }

    public function update(Category $category, FormCategorieRequest $request) {

        $category->update($request->validated());

        return redirect()->route('category.show', ['category' => $category->id])->with('success', "La catégorie a bien été modifié");

    }

}
