<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::table('finance', function (Blueprint $table) {
            $table->string('fin_studentContact')->nullable()->change();
            $table->string('fin_otherPurpose')->nullable();
            $table->string('fin_purpose');
        });
    }

   
    public function down(): void
    {
        Schema::table('finance', function (Blueprint $table) {
            
        });
    }
};
