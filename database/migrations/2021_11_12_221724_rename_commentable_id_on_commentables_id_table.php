<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameCommentableIdOnCommentablesIdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('commentables', function (Blueprint $table) {
            $table->renameColumn('comentable_id', 'commentables_id');
            $table->renameColumn('commentable_type', 'commentables_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('commentables', function (Blueprint $table) {
            $table->renameColumn('commentables_id', 'comentable_id');
            $table->renameColumn('commentables_type', 'commentable_type');
        });
    }
}