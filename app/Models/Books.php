<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Books extends Model
{
    use HasFactory;
    use Sortable;

    protected $fillable = [
        'name', 'authors'
    ];

    public $sortable = ['id', 'name'];


    public function author(){
        return $this->belongsToMany(Authors::class);
    }

}
