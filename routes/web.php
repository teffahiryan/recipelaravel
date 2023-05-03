<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route GET, retournant la vue INDEX dans la racine du dossier VIEWS
Route::get('/', function () {
    return view('index');
    // Nommage de la route pour simplifier le path dans les balises A
})->name('index');


// Route PREFIX, permet d'ajouter un préfixe à toutes les routes qu'il contient, pareil pour le nommage avec NAME, on peut aussi saisir le controller directemment ici
Route::prefix('/recette')->name('recipe.')->controller(RecipeController::class)->group(function (){

    // Route GET, on donne le nom de la fonction utilisé dans le controlleur pour cette route, et on lui donne un nom qui fera suite à celui du préfixe
    Route::get('/', 'index')->name('index');

    // Route GET où on spécifie le slug et l'id qui seront utiliser dans le controlleur, on spécifie toujours la fonction lié au controlleur en question
    Route::get('/{slug}-{id}', 'show')
    ->where([ // Ajout de règles
        // Règle qui accepte seulement les nombres (0-9) pour le paramètre ID
        'id' => '[0-9]+',
        // Règle qui accepte les lettres (a-z) et les nombres (0-9) et accepter les "-" (\-)
        'slug' => '[a-z0-9\-]+'
    ])->name('show');

});



