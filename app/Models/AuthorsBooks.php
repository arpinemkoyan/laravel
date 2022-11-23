<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthorsBooks extends Model
{
    use HasFactory;
    protected $fillable = [
        'books_id', 'authors_id'
    ];
}
