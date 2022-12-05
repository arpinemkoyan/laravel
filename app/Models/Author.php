<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    const PER_PAGE = 5;
    public $table = "authors";
    protected $fillable = [
        'id', 'first_name', 'last_name', 'name'
    ];

    public function books()
    {
        return $this->belongsToMany(Book::class, 'author_book');
    }
}
