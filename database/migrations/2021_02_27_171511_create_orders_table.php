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
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->integer('qty');
            $table->decimal('sub_total', 20, 2);
            $table->decimal('vat', 20, 2);
            $table->decimal('total', 20, 2);
            $table->decimal('pay', 20, 2);
            $table->decimal('due', 20, 2);
            $table->string('pay_by', 20);
            $table->date('date');
            $table->string('month', 20);
            $table->year('year');
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
