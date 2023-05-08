<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'step'
    ];

    // Cette fonction permet de dire que cet article est associé a une catégorie
    public function category () {
        // belongsTo = Appartient à, la relation se fait donc encore ici
        return $this->belongsTo(Category::class);
    }
}
