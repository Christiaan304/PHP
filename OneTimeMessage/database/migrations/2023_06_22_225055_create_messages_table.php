<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('send_from');
            $table->string('send_to');
            $table->string('message');
            $table->string('purl_confirmation', 36)->nullable();
            $table->dateTime('purl_confirmation_sent')->nullable();
            $table->string('purl_read')->nullable();
            $table->dateTime('purl_read_sent')->nullable();
            $table->dateTime('message_read')->nullable();

            $table->datetimes();
            $table->softDeletesDatetime();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
