<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Authors extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name', 'last_name', 'birthday'
    ];

    public function book(){
        return $this->belongsToMany(Books::class );
    }
}
