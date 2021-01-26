<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained();
            $table->foreignId('categoria_id')->constrained();
            $table->string('nombre');
            $table->string('descripcion');
            $table->double('precio');
            $table->double('costo');
            $table->Integer('cantidad');
            $table->boolean('concesionado')->default(1);
            $table->string('motivo')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
