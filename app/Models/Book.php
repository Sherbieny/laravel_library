<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'description',
        'publication_year',
        'cover_image',
        'user_id',
        'category_id',
    ];

    // Define the relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship with Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
