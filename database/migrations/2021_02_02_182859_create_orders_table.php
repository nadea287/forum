<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->string('billibng_email');
            $table->string('billing_name');
            $table->string('billing_city');
            $table->string('billing_province');
            $table->string('billing_postalcode');
            $table->string('billing_phone');
            $table->string('billing_name_on_card');
            $table->string('billing_discount')->default(0);
            $table->string('billing_discount_code')->nullable();
            $table->string('billing_subtotal');
            $table->string('billing_tax');
            $table->string('billing_total');
            $table->string('payment_gateway')->default('stripe');
            $table->boolean('shipped')->default(false);
            $table->string('error')->nullable();

            $table->foreign('user_id')->references('id')->on('users')
                    ->onUpdate('cascade')->onDelete('set null');
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
        Schema::dropIfExists('orders');
    }
}
