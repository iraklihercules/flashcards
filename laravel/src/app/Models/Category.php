<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    const null UPDATED_AT = null; // Fix "updated_at" mismatch error.

    protected $fillable = [
        'title',
    ];
}
