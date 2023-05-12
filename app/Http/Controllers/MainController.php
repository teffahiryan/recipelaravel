<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(): View {

        $categories = Category::all();

        return view('main.index', [
            'categories' => $categories
        ]);

    }

    public function show(): View {

        return view('main.show');
 
    }

    public function page(): View {

        return view('main.page');

    }


}
