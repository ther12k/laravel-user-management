<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNppbkcAnnotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('nppbkc_annotations');
        Schema::create('nppbkc_annotations', function (Blueprint $table) {
            $table->id();
            $table->tinyinteger('status_nppbkc');
            $table->string('catatan_petugas');
            $table->unsignedBigInteger('nppbkc_id');
            $table->foreign('nppbkc_id')
                ->references('id')
                ->on('nppbkcs')
                ->onDelete('cascade');
            $table->blameable();
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
        Schema::dropIfExists('nppbkc_annotations');
    }
}
