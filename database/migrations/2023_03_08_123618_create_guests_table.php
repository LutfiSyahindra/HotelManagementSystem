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
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('room_id');
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
            // $table->unsignedBigInteger('fasilitas_id');
            // $table->foreign('fasilitas_id')->references('id')->on('fasilitas')->onDelete('cascade');
            $table->string('name');
            $table->string('nik');
            $table->string('ttl');
            $table->string('jk');
            $table->string('address');
            $table->string('no_tlp');
            $table->string('check_in');
            $table->string('check_out');
            $table->integer('total');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guests');
    }
};
