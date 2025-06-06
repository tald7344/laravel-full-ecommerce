<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title_en')->nullable();
            $table->string('title_ar')->nullable();
            $table->string('photo')->nullable();
            $table->longText('content_en')->nullable();
            $table->longText('content_ar')->nullable();

            $table->integer('department_id')->unsigned()->nullable();
            $table->foreign('department_id')->references('id')->on('departements')->onDelete('cascade');

            $table->integer('manufactory_id')->unsigned()->nullable();
            $table->foreign('manufactory_id')->references('id')->on('manufactories')->onDelete('cascade');

            $table->integer('color_id')->unsigned()->nullable();
            $table->foreign('color_id')->references('id')->on('colors')->onDelete('cascade');

            // result : 3 Inches
            $table->string('size')->nullable();
            $table->integer('size_id')->unsigned()->nullable();
            $table->foreign('size_id')->references('id')->on('sizes')->onDelete('cascade');

            $table->integer('currency_id')->unsigned()->nullable();
            $table->foreign('currency_id')->references('id')->on('countries');

            $table->integer('trade_id')->unsigned()->nullable();
            $table->foreign('trade_id')->references('id')->on('trade_marks')->onDelete('cascade');

            $table->integer('price')->default(0);

            $table->integer('stock')->default(0);   // To store the number of products stored in the warehouse

            $table->date('start_at')->nullable();       // to give the ability to hide product or display it for period of time
            $table->date('end_at')->nullable();

            $table->date('start_offer_at')->nullable(); // to give the ability to hide offers or display it for period of time
            $table->date('end_offer_at')->nullable();
            $table->integer('price_offer')->nullable();   // to give the ability to hide offers prices or display it for period of time

            // result : 10 Kg
            $table->string('weight')->nullable();
            $table->integer('weight_id')->unsigned()->nullable();
            $table->foreign('weight_id')->references('id')->on('weights')->onDelete('cascade');

//            $table->longText('other_data')->nullable();     // to give ability to create any new input
            $table->enum('status', ['pending', 'refused', 'active'])->default('pending');   // for product state
            $table->boolean('is_hot')->default(0);
            $table->longtext('reason')->nullable();         // to insert more information about product
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
        Schema::dropIfExists('products');
    }
}
