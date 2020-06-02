<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameRelationshipAtBuku extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('buku', function (Blueprint $table) {
            $table->renameColumn('id_penerbit', 'penerbit_id');
            $table->renameColumn('id_author', 'author_id');
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
            $table->renameColumn('penerbit_id', 'id_penerbit');
            $table->renameColumn('author_id', 'id_author');
        });
    }
}
