<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('type')->nullable();
            $table->string('title')->nullable();
            $table->decimal('starting_price', 12, 2, true)->nullable();
            $table->text('button_url')->nullable();
            $table->text('slider_image')->nullable();
            $table->tinyInteger('slider_number', false, true)->nullable();
            $table->boolean('slider_status')->nullable();
            $table->datetimes();
            $table->softDeletesDatetime();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sliders');
    }
};
