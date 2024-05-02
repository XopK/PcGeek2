<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComponentCategory extends Model
{
    use HasFactory;

    protected $table = 'component_categories';

    protected $fillable = [
        'title_category_components',
    ];
}
