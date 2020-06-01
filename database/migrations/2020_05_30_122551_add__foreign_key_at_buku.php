<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyAtBuku extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints('buku', function (Blueprint $table) {
            $table->foreign('id_penerbit')->references('id')->on('penerbit')->onDelete('cascade');
            $table->foreign('id_author')->references('id')->on('author')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints('buku', function (Blueprint $table) {
            $table->dropForeign('buku_id_penerbit_foreign');
            $table->dropForeign('buku_id_author_foreign');
        });
    }
}
