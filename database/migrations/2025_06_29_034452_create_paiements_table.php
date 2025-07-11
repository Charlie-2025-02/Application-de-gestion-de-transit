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
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();

            // Liens vers les autres entités
            $table->foreignId('facture_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('client_id')->constrained()->onDelete('cascade'); 

            // Infos carte bancaire
            $table->string('nom_titulaire');
            $table->string('numero_carte');
            $table->string('cvv');
            $table->string('expiration');

            // Détails du paiement
            $table->decimal('montant', 10, 2);
            $table->date('date_paiement');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiements');
    }
};
