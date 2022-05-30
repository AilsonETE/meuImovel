<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableImovelCategoia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imoveis_categorias', function (Blueprint $table) {
            $table->unsignedBigInteger('imovel_id');
            $table->unsignedBigInteger('categoria_id');

            $table->timestamps();

            $table->foreign('imovel_id')->references('id')->on('imoveis');
            $table->foreign('categoria_id')->references('id')->on('categorias');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imoveis_categorias');
    }
}
