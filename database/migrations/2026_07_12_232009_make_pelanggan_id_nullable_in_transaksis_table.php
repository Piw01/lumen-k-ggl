<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transaksis', function (Blueprint $table) {
            // Mengubah kolom pelanggan_id agar boleh kosong (nullable)
            $table->bigInteger('pelanggan_id')->unsigned()->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('transaksis', function (Blueprint $table) {
            $table->bigInteger('pelanggan_id')->unsigned()->nullable(false)->change();
        });
    }
};