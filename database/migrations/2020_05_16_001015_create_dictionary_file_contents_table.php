<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDictionaryFileContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dictionary_file_contents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dictionary_file_id');
            $table->string('column_key');
            $table->string('column_value');
            $table->foreign('dictionary_file_id')->references('id')->on('dictionary_files')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dictionary_file_contents');
    }
}
