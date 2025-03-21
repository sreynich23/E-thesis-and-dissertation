<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

class Student extends Model implements Authenticatable
{
    use HasFactory, AuthenticatableTrait;

    protected $fillable = ['id_number', 'password', 'name', 'role']; // Include 'role'

    protected $hidden = ['password'];
}
