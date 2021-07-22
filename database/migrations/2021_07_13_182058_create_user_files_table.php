<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('user_files');
        Schema::create('user_files', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->string('name');
            $table->string('title');
            $table->string('filename');
            $table->string('original_filename');
            $table->integer('size');
            $table->string('ext');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('nppbkc_users')
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
        Schema::dropIfExists('user_files');
    }
}
