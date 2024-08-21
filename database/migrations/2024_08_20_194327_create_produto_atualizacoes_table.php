<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutoAtualizacoesTable extends Migration
{
    public function up()
    {
        Schema::create('produto_atualizacoes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produto_id');
            $table->integer('quantidade');
            $table->integer('vendas');
            $table->timestamps();

            $table->foreign('produto_id')->references('id')->on('produtos')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('produto_atualizacoes');
    }
}

