<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->nullable();
            $table->text('image_path')->nullable();
            $table->string('phone_id')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->enum('role', ['root', 'admin', 'vendor', 'user'])->default('user');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->string('password');
            $table->rememberToken();
            $table->datetimes();
            $table->softDeletesDatetime();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
