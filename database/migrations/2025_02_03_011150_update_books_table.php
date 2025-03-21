<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        // Modify the books table
        Schema::table('books', function (Blueprint $table) {
            $table->string('generation')->nullable()->after('id'); // Add generation field
            $table->year('year')->nullable()->after('generation');  // Add year field
        });

        // Drop the generations table
        Schema::dropIfExists('generations');
    }

    public function down()
    {
        // Rollback changes
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn(['generation', 'year']);
        });

        // Recreate the generations table (if needed)
        Schema::create('generations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
    }
};
