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
        Schema::table('cashier', function (Blueprint $table) {
            $table->string('cash_studentContact')->nullable()->change();
            $table->string('cash_otherPurpose')->nullable();
            $table->string('cash_purpose');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cashier', function (Blueprint $table) {
            //
        });
    }
};
