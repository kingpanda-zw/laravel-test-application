<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerDepositPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_deposit_payments', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->string('customer_email');
            $table->unsignedBigInteger('product_id');
            $table->double('deposit');
            $table->double('balance');
            $table->enum('status', ['pending', 'success', 'failed']);
            $table->boolean('email_sent')->default(false);
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
        Schema::dropIfExists('customer_deposit_payments');
    }
}
