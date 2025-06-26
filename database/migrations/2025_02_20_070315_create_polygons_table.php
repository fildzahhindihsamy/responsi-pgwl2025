<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('polygons', function (Blueprint $table) {
            $table->id();
            $table->geometry('geom'); // geometry polygon
            $table->string('nama_area');
            $table->string('tenaga_pembangkit');
            $table->text('rencana_pengembangan')->nullable();
            $table->string('wilayah');
            $table->text('alasan');
            $table->string('surveyor');
            $table->string('image')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            // foreign key ke tabel users (asumsi ada tabel users)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('polygons');
    }
};
