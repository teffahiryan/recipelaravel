<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            // J'ajoute la propriété nom à la table categories
            $table->string('name');
            $table->timestamps();
        });
        // Relation 1/n | One To Many | Une recette peut avoir une seule catégorie et une catégorie peut avoir plusieurs recettes
        // Pour cette relation il y a besoin d'une clé étrangère dans la table RECIPES qu'on va modifier en dessous, une migration ne cible pas qu'une seule table
        Schema::table('recipes', function (Blueprint $table) {
            // Création de la clé étrange dans la table RECIPES, on doit seulement lui passer le MODEL category
            // Nullable, permet de rendre la propriété nullable
            $table->foreignIdFor(\App\Models\Category::class)->nullable()->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
        // On ajoute ici la manière de revenir en arrière selon le UP en cas de besoin, on supprime donc la clé étrangère
        Schema::table('recipes', function (Blueprint $table) {
            $table->dropForeignIdFor(\App\Models\Category::class);
        });
    }
};
