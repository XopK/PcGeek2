<?php

use Database\Seeders\AdminUser;
use Database\Seeders\UserRole;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('login')->unique();
            $table->string('email')->unique();
            $table->string('phone');
            $table->boolean('is_blocked')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->foreignId('id_role')->references('id')->on('roles');
            $table->string('password');
            $table->string('profile_img')->default('profile.svg');
            $table->rememberToken();
            $table->timestamps();
        });

        Artisan::call('db:seed', ['--class' => AdminUser::class]);
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
};
