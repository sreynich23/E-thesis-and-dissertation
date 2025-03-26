<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();  // Auto-incrementing primary key
            $table->unsignedBigInteger('id_majors');  // Foreign key for majors
            $table->unsignedBigInteger('id_generation');  // Foreign key for generation
            $table->string('title');  // File path for the cover image
            $table->string('cover')->nullable();  // File path for the cover image
            $table->string('path_file');  // File path for the book (PDF, etc.)
            $table->timestamps();  // created_at and updated_at timestamps

            // Foreign key constraints (assuming you have 'majors' and 'generations' tables)
            $table->foreign('id_majors')->references('id')->on('majors')->onDelete('cascade');
            $table->foreign('id_generation')->references('id')->on('generations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
