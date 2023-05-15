<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'step',
        'category_id',
        'image',
        'dayRecipe',
        'preparationTime'
    ];

    // Cette fonction permet de dire que cet article est associé a une catégorie
    public function category () {
        // belongsTo = Appartient à, la relation se fait donc encore ici
        return $this->belongsTo(Category::class);
    }

    public function ingredients () {
        return $this->belongsToMany(Ingredient::class)->withPivot('quantity', 'unit');
    }

    public function imageUrl (): string {
        return Storage::url($this->image);
    }
}
