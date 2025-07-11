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
        Schema::create('factures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->foreignId('dossier_id')->constrained()->onDelete('cascade');
            $table->string('numero_facture')->unique();
            $table->date('date_facture');
            $table->decimal('montant_ht', 10, 2);
            $table->decimal('tva', 5, 2)->default(18.00);
            $table->decimal('montant_ttc', 10, 2);
            $table->enum('statut', ['en_attente', 'paye', 'annule'])->default('en_attente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factures');
    }
};
