<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_majors',
        'generation',
        'year',
        'title',
        'path_file',
    ];

    // Define the relationships if necessary (optional)
    public function major()
    {
        return $this->belongsTo(Major::class, 'id_majors');
    }

}
