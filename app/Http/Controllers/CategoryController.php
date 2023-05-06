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

    public function create() {
        
        return view('category.create');
    }
    
    public function store(FormCategorieRequest $request) {

        $category = Category::create($request->validated());

        return redirect()->route('category.index')->with('success', "La catégorie a été créé avec succès");

    }

}
