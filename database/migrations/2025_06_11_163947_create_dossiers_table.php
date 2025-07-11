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
        Schema::create('dossiers', function (Blueprint $table) {
            $table->id(); // Clé primaire auto-incrémentée
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');

            $table->string('titre');
            $table->text('description')->nullable();
            $table->string('numero_dossier')->unique();
            $table->string('objet');
            $table->enum('type_transport', ['terrestre', 'maritime', 'aerien']);
            $table->string('depart');
            $table->string('arrivee');
            $table->date('date_depart');
            $table->date('date_arrivee');
            $table->string('vehicule');
            $table->string('chauffeur');
            $table->enum('statut', ['en_attente', 'en_cours', 'terminé',])->default('en_attente');
            $table->text('remarques')->nullable();

            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dossiers');
    }
};
