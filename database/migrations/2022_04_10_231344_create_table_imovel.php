<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableImovel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imoveis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // referencia da chave estrangeira
            $table->string('titulo');
            $table->string('descricao');
            $table->text('conteudo');
            $table->float('price', 10,2);
            $table->integer('banheiro');
            $table->integer('quarto');
            $table->integer('area_propriedade');
            $table->integer('total_area_propriedade');
            $table->string('slug');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imoveis');
    }
}
