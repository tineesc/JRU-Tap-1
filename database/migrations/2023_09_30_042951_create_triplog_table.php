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
        Schema::create('triplogs', function (Blueprint $table) {
            $table->id();
            $table->string('location')->nullable();
            $table->string('destination')->nullable();
            $table->date('date')->format('d-m-y')->nullable();
            $table->time('time')->format('H:i')->nullable();
            $table->time('departure')->format('H:i')->nullable();
            $table->integer('fare')->nullable();
            $table->integer('count')->nullable();
            $table->string('jnumber')->nullable();
            $table->string('driver')->nullable();
            $table->string('trips')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('triplogs');
    }
};
