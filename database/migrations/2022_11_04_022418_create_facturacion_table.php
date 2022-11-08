<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturacion', function (Blueprint $table) {
            $table->id();
            $table->date('fecha')->nullable();
            $table->string('cliente',50);
            $table->string('dui',10)->nullable();
            $table->string('nit',50)->nullable();
            $table->string('nrc',50)->nullable();
            $table->string('giro',50)->nullable();
            $table->string('direccion',50)->nullable();
            $table->foreignId('id_pedidocliente')
            ->nullable()
            ->constrained('pedidos')
            ->cascadeOnUpdate()
            ->nullOnDelete();
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
        Schema::dropIfExists('facturacion');
    }
}
