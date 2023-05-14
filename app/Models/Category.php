<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image'];

    public function recipes() {
        return $this->hasMany(Recipe::class);
    }

    public function imageUrl (): string {
        return Storage::url($this->image);
    }
}
