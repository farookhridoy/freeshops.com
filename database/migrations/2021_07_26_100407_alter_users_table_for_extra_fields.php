<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersTableForExtraFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('avatar')->default('default.png')->after('id');
            $table->text('bio')->nullable()->after('password');
            $table->string('phone')->nullable()->after('bio');
            $table->string('website')->nullable()->after('phone');
            $table->string('location')->nullable()->after('website');
            $table->string('location_lat')->nullable()->after('location');
            $table->string('location_long')->nullable()->after('location_lat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
