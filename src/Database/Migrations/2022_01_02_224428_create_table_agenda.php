<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableAgenda extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caled_agenda_item', function (Blueprint $table) {
            $table->id();
            $table->integer('creador_id')->nullable();
            $table->integer('cliente_id')->nullable();
            $table->integer('atendedor_id')->nullable();
            $table->dateTime('fecha')->nullable();
            $table->time('hora')->nullable();
            $table->enum('asistio', [0,1])->default(0);
            $table->integer('agenda_tipo_id')->nullable();
            $table->text('observacion')->nullable();
            $table->integer('estado')->default(1);
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
        Schema::dropIfExists('caled_agenda');
    }
}
