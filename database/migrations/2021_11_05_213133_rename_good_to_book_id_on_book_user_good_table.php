<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameGoodToBookIdOnBookUserGoodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('book_user_good', function (Blueprint $table) {
            $table->renameColumn( 'good', 'book_id' );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('book_user_good', function (Blueprint $table) {
            $table->renameColumn( 'book_id', 'good' );
        });
    }
}