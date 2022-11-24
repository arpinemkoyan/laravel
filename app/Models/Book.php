<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Book extends Model
{
    use HasFactory;
    use Sortable;
    public $table = "books";
    protected $fillable = [
        'name'
    ];

    public $sortable = ['id', 'name'];


    public function authors()
    {
        return $this->belongsToMany(Author::class, 'author_book');
    }

}
