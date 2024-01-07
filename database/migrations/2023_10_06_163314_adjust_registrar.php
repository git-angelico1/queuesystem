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
        Schema::table('registrar', function (Blueprint $table) {   

            $table->text('reg_purpose');
            $table->text('reg_otherPurpose');
            
        });
    }

    public function down(): void
    {
        //
    }
};
