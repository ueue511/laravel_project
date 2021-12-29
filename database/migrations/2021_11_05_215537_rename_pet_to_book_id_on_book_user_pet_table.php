<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenamePetToBookIdOnBookUserPetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('book_user_pet', function (Blueprint $table) {
            $table->renameColumn( 'pet', 'book_id' );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('book_user_pet', function (Blueprint $table) {
            $table->renameColumn( 'book_id', 'pet' );
        });
    }
}