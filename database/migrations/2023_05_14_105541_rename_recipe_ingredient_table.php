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
        Schema::rename('recipe_ingredient', 'ingredient_recipe');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('ingredient_recipe', 'recipe_ingredient');
    }
};
