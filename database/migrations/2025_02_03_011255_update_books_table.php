<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn('id_generation'); // Remove the id_generation column
        });
    }

    public function down()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->unsignedBigInteger('id_generation')->nullable(); // Restore id_generation if rolled back
        });
    }
};
