<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories'; // optional, Laravel assumes this
    protected $primaryKey = 'id'; // optional, Laravel assumes 'id'

    protected $fillable = ['name'];

    public function news()
    {
        return $this->hasMany(News::class, 'categories_id'); // specify foreign key
    }
}