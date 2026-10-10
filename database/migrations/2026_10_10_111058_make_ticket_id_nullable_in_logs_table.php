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
        Schema::table('logs', function (Blueprint $table) {
            // 1. Supprimer la clé étrangère existante
            $table->dropForeign(['ticket_id']);

            // 2. Rendre la colonne nullable
            $table->foreignId('ticket_id')->nullable()->change();

            // 3. Recréer la clé étrangère
            $table->foreign('ticket_id')
                  ->references('id')
                  ->on('tickets')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('logs', function (Blueprint $table) {
            // 1. Supprimer la clé étrangère existante
            $table->dropForeign(['ticket_id']);

            // 2. Rendre la colonne non nullable
            $table->foreignId('ticket_id')->nullable(false)->change();

            // 3. Recréer la clé étrangère
            $table->foreign('ticket_id')
                  ->references('id')
                  ->on('tickets')
                  ->onDelete('cascade');
        });
    }
};
