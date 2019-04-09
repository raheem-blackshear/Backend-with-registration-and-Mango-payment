<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('titolare');
            $table->bigInteger('Piva');
            $table->string('codice_agente', 10);
            $table->string('mail', '65');
            $table->string('telefono_cellulare', 30);
            $table->string('nomeattivita', 100);
            $table->string('tipo_contratto', 100);
            $table->smallInteger('Conferma');
            $table->string('Orario', 150)->nullable();
            $table->integer('prezzo_minimo')->nullable();
            $table->integer('prezzo_massimo')->nullable();
            $table->integer('sconto_minimo')->nullable();
            $table->integer('sconto_massimo')->nullable();
            $table->longText('descrizione')->nullable();
            $table->text('indirizzo')->nullable();
            $table->string('telefono_fisso', 30)->nullable();
            $table->string('sito', 65)->nullable();
            $table->string('link_facebook', 65)->nullable();
            $table->string('link_instagram', 65)->nullable();
            $table->string('link_trip_advisor', 65)->nullable();
            $table->string('link_youtube', 65)->nullable();
            $table->string('link_pinterest', 65)->nullable();
            $table->boolean('paid')->nullable();
            $table->date('paid_time')->nullable();
            $table->float('paid_amount')->nullable();
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
        Schema::dropIfExists('contracts');
    }
}
