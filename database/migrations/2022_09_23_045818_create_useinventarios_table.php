<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUseinventariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('useinventarios', function (Blueprint $table) {
            $table->id();
            $table->string('cod',15);
            $table->string('nombre',25);
            $table->string('descripcion',50);
            $table->integer('cantidad');
            $table->decimal('precio', 8, 2);
            $table->decimal('uso', 8, 2);
            $table->integer('estado');
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
        Schema::dropIfExists('useinventarios');
    }
}
