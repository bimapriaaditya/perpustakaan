<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenamePenerbitPenulisAtBuku extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('buku', function (Blueprint $table) {
            $table->renameColumn('penerbit', 'id_penerbit');
            $table->renameColumn('penulis', 'id_author');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('buku', function (Blueprint $table) {
            $table->renameColumn('id_penerbit', 'penerbit');
            $table->renameColumn('id_author', 'penulis');
        });
    }
}
