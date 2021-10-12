<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('customer_orders')) {
            Schema::create('customer_orders', function (Blueprint $table) {
                $table->id();
                $table->string('order_id');
                $table->string('customer_email');
                $table->unsignedBigInteger('product_id');
                $table->enum('status', ['pending', 'success', 'failed']);
                $table->boolean('email_sent')->default(false);
                $table->timestamps();
            });

        }

        Schema::table('customer_orders', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_orders');
    }
}
