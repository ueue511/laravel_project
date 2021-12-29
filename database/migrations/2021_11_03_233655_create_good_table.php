<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * いいねテーブル
     */
    public function up()
    {
        Schema::create('good', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer( 'good' );
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
        Schema::dropIfExists('good');
    }
}