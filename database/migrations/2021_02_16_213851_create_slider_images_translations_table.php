<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSliderImagesTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slider_images_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('slider_images_id')->unsigned();
            $table->string('locale');
            $table->text('title');

            $table->unique(['slider_images_id', 'locale']);
            $table->foreign('slider_images_id')->references('id')->on('slider_images')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('slider_images_translations');
    }
}
