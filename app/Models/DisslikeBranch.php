<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisslikeBranch extends Model
{
    use HasFactory;

    protected $fillable = ['id_user', 'id_post'];

    protected $table = 'disslike_branchs';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
