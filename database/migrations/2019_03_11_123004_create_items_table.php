<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->bigInteger('price');
            $table->integer('stock');
            $table->text('description');
            $table->uuid('gender_id');
            $table->uuid('type_id');
            $table->uuid('supplier_id');
            $table->foreign('gender_id')->references('id')->on('genders');
            $table->foreign('type_id')->references('id')->on('types');
            $table->foreign('supplier_id')->references('id')->on('suppliers');
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
        Schema::dropIfExists('items');
    }
}
