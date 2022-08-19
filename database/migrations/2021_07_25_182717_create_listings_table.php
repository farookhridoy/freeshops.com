<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->references('id')->on('categories')->constrained()->onDelete('cascade');
            $table->text('featured_image')->nullable();
            $table->text('title');
            $table->text('slug');
            $table->longText('description');
            $table->text('video_url')->nullable();
            $table->string('phone');
            $table->string('email');
            $table->string('location');
            $table->string('location_lat');
            $table->string('location_long');
            $table->boolean('show_map')->default(1);
            $table->enum('availablity', ['1', '2'])->default('1')->comment('1. Available, 2. Sold');
            $table->enum('status', ['1', '2', '3'])->default('1')->comment('1. In Review, 2. Published, 3. Rejected');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations/.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('listings');
    }
}
