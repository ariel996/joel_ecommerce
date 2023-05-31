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
        Schema::table('retour_produits', function (Blueprint $table) {
            $table->dropColumn('reference_commande');
            $table->string('code_produit');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('retour_produits', function (Blueprint $table) {
            //
        });
    }
};
