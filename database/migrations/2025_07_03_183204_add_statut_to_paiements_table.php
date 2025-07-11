<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('paiements', function (Blueprint $table) {
            $table->enum('statut', ['en_attente', 'paye', 'annulé'])->default('en_attente');
        });
    }


    public function down(): void
    {
        Schema::table('paiements', function (Blueprint $table) {
            $table->dropColumn('statut');
        });
    }
};
