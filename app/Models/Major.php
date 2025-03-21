<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    use HasFactory;

    // Define the fillable fields
    protected $fillable = [
        'major_name',
        'degree_level',
    ];
    public function books()
    {
        return $this->hasMany(Book::class, 'id_majors');
    }
}
