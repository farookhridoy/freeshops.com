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
            $table->string('order_no')->unique();
            $table->foreignId('transaction_id')->references('id')->on('transactions')->constrained()->onDelete('cascade');
            $table->foreignId('listing_id')->references('id')->on('listings')->constrained()->onDelete('cascade');
            $table->float('amount')->default(0);
            $table->enum('status', ['1', '2', '3'])->default(1)->comment('1. Active, 2. Completed, 3. Cancelled');
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
