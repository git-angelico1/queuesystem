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
        Schema::create('registrar', function (Blueprint $table) {
            $table->id();
            $table->string('reg_name');
            $table->string('reg_studentId', 15);
            $table->string('reg_studentContact', 15);
            $table->string('reg_generate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrar');
    }
};
