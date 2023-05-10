<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\MainController;

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
Route::get('/', [\App\Http\Controllers\MainController::class, 'index'])->name('index');

Route::get('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('auth.login');
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'doLogin']);
Route::delete('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('auth.logout');

// Route PREFIX, permet d'ajouter un préfixe à toutes les routes qu'il contient, pareil pour le nommage avec NAME, on peut aussi saisir le controller directemment ici
Route::prefix('/recette')->name('recipe.')->controller(RecipeController::class)->group(function (){

    // Route GET, on donne le nom de la fonction utilisé dans le controlleur pour cette route, et on lui donne un nom qui fera suite à celui du préfixe
    Route::get('/', 'index')->name('index');

    // Route GET où on spécifie le slug et l'objet RECIPE qui seront utilisé dans le controleur, on spécifie toujours la fonction lié au controlleur en question
    Route::get('/{slug}-{recipe}', 'show')
    ->where([ // Ajout de règles
        // Règle qui accepte seulement les nombres (0-9) pour le paramètre ID
        'recipe' => '[0-9]+',
        // Règle qui accepte les lettres (a-z) et les nombres (0-9) et accepter les "-" (\-)
        'slug' => '[a-z0-9\-]+'
    ])->name('show');

    // Route GET, qui va diriger vers le formulaire de création d'une recette
    // le middleware auth permet de dire que l'utilisateur doit etre connecte pour acceder a cette page
    Route::get('/new', 'create')->name('create')->middleware('auth');
    // Route POST, qui va envoyer les données et rediriger vers une autre page, donc pas de vue ici
    Route::post('/new', 'store')->middleware('auth');

    // Ici on a le même fonctionnement que pour le create, seulement on inclu l'objet RECIPE dans l'url pour la modification
    Route::get('/{recipe}/edit', 'edit')->name('edit')->middleware('auth');
    Route::post('/{recipe}/edit', 'update')->middleware('auth');

});

Route::prefix('/categorie')->name('category.')->controller(CategoryController::class)->group(function(){

    Route::get('/', 'index')->name('index');

    Route::get('/new', 'create')->name('create')->middleware('auth');
    Route::post('/new', 'store')->middleware('auth');

});

Route::prefix('/ingredient')->name('ingredient.')->controller(IngredientController::class)->group(function(){

    Route::get('/', 'index')->name('index');

    Route::get('/new', 'create')->name('create')->middleware('auth');
    Route::post('/new', 'store')->middleware('auth');

});
