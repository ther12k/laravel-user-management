<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNppbkcFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nppbkc_files', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->string('name');
            $table->string('title');
            $table->string('filename');
            $table->string('original_filename');
            $table->integer('size');
            $table->string('ext');
            $table->tinyinteger('is_annotation')->default(0);
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
        Schema::dropIfExists('nppbkc_files');
    }
}
