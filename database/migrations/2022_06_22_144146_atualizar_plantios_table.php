<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AtualizarPlantiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plantios', function (Blueprint $table) { 
            $table->integer('valor_incremento')->nullable()->change();
            $table->integer('valor_compensacao')->nullable()->change();
            $table->integer('valor_reparacao')->nullable()->change();
            $table->integer('tca_firmado')->nullable()->change();
            $table->integer('tca_executado')->nullable()->change();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}
