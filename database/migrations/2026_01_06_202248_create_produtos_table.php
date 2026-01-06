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
        // Só adicionei as colunas de relação com a nfe, a descrição do produto
        // e a quantidade do produto
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nfe_id')->constrained('nfes')->onDelete('cascade');
            $table->string('ds_produto');
            $table->integer('nr_quantidade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
