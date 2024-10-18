<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flashcard extends Model
{
    use HasFactory;

    const null UPDATED_AT = null; // Fix "updated_at" mismatch error.

    protected $fillable = [
        'title',
        'translation',
        'description',
        'category_id',
        'theme_id',
    ];
}
