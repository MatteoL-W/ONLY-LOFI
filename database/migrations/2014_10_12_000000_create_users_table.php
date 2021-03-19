<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('description')->default('Lo-fi is so cool !');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('avatar');
            $table->date('birthday');
            $table->string('youtube')->default('');
            $table->string('soundcloud')->default('');
            $table->string('twitter')->default('');
            $table->string('instagram')->default('');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
