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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('expediteur_id');
            $table->foreign('expediteur_id')->references('id')->on('users')->cascadeOnDelete();

            $table->unsignedBigInteger('destinataire_id');
            $table->foreign('destinataire_id')->references('id')->on('users')->cascadeOnDelete();

            $table->string('contenue');
            $table->string('objet');
            $table->string('type');
            $table->date('date');
            $table->time('heure');
            $table->boolean('status')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
