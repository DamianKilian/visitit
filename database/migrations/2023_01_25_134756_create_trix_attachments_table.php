<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trix_attachments', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('file_name');
            $table->string('mime_type');
            $table->string('path');
            $table->unsignedBigInteger('size');

            $table->timestamps();

            $table->unsignedBigInteger('place_id')->nullable();
            $table->foreign('place_id')
                ->references('id')->on('places')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trix_attachments');
    }
};
