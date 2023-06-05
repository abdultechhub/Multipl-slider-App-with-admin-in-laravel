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
        Schema::create('slider_items', function (Blueprint $table) {
            $table->id();
            $table->integer('slider_id');
            $table->string('title');
            $table->string('slug');
            $table->string('link')->nullable();
            $table->string('link_text')->nullable();
            $table->text('content')->nullable();
            $table->string('slider_image_desk')->nullable();
            $table->string('slider_image_tab')->nullable();
            $table->string('slider_image_mobile')->nullable();
            $table->tinyInteger('position')->default(0);
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('slider_items');
    }
};
