<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('links', function (Blueprint $table) {
            $table->increments('id');
            $table->string('link_name_en');
            $table->string('link_name_ar');
            $table->text('link_content_en')->nullable();
            $table->text('link_content_ar')->nullable();
            $table->string('url')->nullable();
            $table->string('parent')->default(0);
            $table->boolean('hasLink')->default(0);
            $table->integer('menu_id')->unsigned();
            $table->foreign('menu_id')->references('id')->on('menu')->onDelete('cascade');
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
        Schema::dropIfExists('links');
    }
}
