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
        if (!Schema::hasTable('customer_deposit_payments')) {
            Schema::create('customer_deposit_payments', function (Blueprint $table) {
                $table->id();
                $table->string('order_id');
                $table->string('customer_email');
                $table->string('customer_id')->nullable();
                $table->unsignedBigInteger('product_id');
                $table->double('deposit');
                $table->double('balance');
                $table->enum('deposit_status', ['pending', 'success', 'failed']);
                $table->enum('balance_status', ['pending', 'success', 'failed']);
                $table->boolean('email_sent')->default(false);
                $table->boolean('deposit_email_sent')->default(false);
                $table->timestamps();
            });
        }

        Schema::table('customer_deposit_payments', function (Blueprint $table) {
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
        Schema::dropIfExists('customer_deposit_payments');
    }
}
