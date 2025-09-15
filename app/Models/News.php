<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'title',
        'content',
        'status',
        'image',
        'user_id',
        'categories_id',
    ];

    // Relation with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation with Category
    public function category()
    {
        return $this->belongsTo(Category::class, 'categories_id');
    }
}