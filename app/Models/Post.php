<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_post',
        'description',
        'image_posts',
        'id_user',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tag_posts', 'id_post', 'id_tag');
    }

    public function likes()
    {
        return $this->hasMany(LikeBranch::class, 'id_post');
    }

    public function disslikes()
    {
        return $this->hasMany(DisslikeBranch::class, 'id_post');
    }

    public function likesCount()
    {
        return $this->likes->count();
    }

    public function disslikesCount()
    {
        return $this->disslikes->count();
    }

    public function components()
    {
        return $this->belongsToMany(Component::class, 'component_posts', 'id_post', 'id_component');
    }
}
