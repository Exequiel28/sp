<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordenes', function (Blueprint $table) {
            $table->id();
            $table->string('producto',50);
            $table->decimal('ancho', 8, 2);
            $table->decimal('alto', 8, 2);
            $table->date('fecha_entrega')->nullable();
            $table->date('hora_entrega')->nullable();
            $table->decimal('precio', 8, 2);
            $table->decimal('preciodis', 8, 2);
            $table->decimal('total', 8, 2);
            $table->string('estado',10);
            $table->string('userventa',25);
            $table->string('descripcion',250);
            $table->integer('copias');
            $table->date('hora_impresion')->nullable();
            $table->timestamps();

            $table->foreignId('id_pedido')
                    ->nullable()
                    ->constrained('pedidos')
                    ->cascadeOnUpdate()
                    ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ordenes');
    }
}
