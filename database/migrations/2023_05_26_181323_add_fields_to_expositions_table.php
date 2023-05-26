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
        Schema::table('expositions', function (Blueprint $table) {
            $table->string('rue')->nullable();
            $table->string('code')->nullable();
            $table->string('ville')->nullable();
            $table->string('pays')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('expositions', function (Blueprint $table) {
            //
        });
    }
};
