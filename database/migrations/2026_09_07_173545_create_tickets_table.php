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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            //$table->uuid('uuid')->nullable();

               // User qui a créé le ticket
            $table->foreignId('created_by')  //$table->foreignId('user_id')->constrained('users')->onDelete('cascade');//references('id')on('users') ;
                ->constrained('users')
                ->nullOnDelete();;

                //je préférerais conserver les tickets même si l'utilisateur est supprimé.
                //->cascadeOnDelete();

            // Agent auquel le ticket est assigné
            $table->foreignId('assigned_to')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

           // je ne peux pas supprimer une catégorie tant que des tickets l'utilisent.
            $table->foreignId('category_id')->constrained('categories')->restrictOnDelete();
            $table->string('title');
            $table->text('message')->required();
            $table->enum('status',['open','in_progress','archived','closed'])->default('open');
            $table->enum('priority',['low','medium','high','urgent'])->default('medium');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
