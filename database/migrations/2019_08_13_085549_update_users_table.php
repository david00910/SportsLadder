<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
        public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('gender')->nullable()->change();
            $table->string('phone')->nullable()->change();
            $table->integer('ranking')->nullable()->change();
            $table->bigInteger('address_id')->unsigned()->nullable()->change();
            $table->integer('is_admin')->default(0)->change();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('gender')->nullable(false)->change();
            $table->string('phone')->nullable(false)->change();
            $table->integer('ranking')->nullable(false)->change();
            $table->bigInteger('address_id')->unsigned()->nullable(false)->change();
            $table->integer('is_admin')->nullable()->change();
        });
    }
}
