<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    const ROLE_USER = 1;
    const ROLE_AUTHOR = 0;


    public $table = "users";
    protected $fillable = [
        'id',
        'name',
        'role',
        'password',
        'email',
        'author_id',
        'first_name',
        'last_name'
    ];


}
