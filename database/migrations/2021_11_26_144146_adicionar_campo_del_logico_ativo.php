<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdicionarCampoDelLogicoAtivo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plantios', function (Blueprint $table) {
            $table->boolean('ativo')->default(1)->nullable()->after('tca_executado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plantios', function (Blueprint $table) {
            $table->dropColumn('ativo');
        });
    }
}
