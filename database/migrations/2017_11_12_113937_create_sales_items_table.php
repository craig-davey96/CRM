<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_items', function (Blueprint $table) {
            $table->increments('sales_item_id');
            $table->string('sales_item_name')->nullable();
            $table->decimal('sales_item_price' , 10, 2);
            $table->enum('sales_active' , ['Y','N']);
            $table->text('sales_item_description')->nullable();
            $table->text('sales_item_tags')->nullable();
            $table->integer('sales_item_added_by')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('sales_item_added_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_items');
    }
}
