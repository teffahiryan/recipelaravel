<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(): View {

        $categories = Category::all();

        return view('index', [
            'categories' => $categories
        ]);

    }
}
