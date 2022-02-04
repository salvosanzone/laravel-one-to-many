<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            // creo una nuova colonna 
            $table->unsignedBigInteger('category_id')->nullable()->after('id');

            // assegno la FK alla colonna creata
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            // se faccio l' UP allora devo fare anche il DOWN prima per la chiave e poi per la colonna
            $table->dropForeign(['category_id']);
            $table->dropColumn(['category_id']);
        });
    }
}
