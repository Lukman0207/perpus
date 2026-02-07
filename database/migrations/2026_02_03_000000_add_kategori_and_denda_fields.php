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
        Schema::table('books', function (Blueprint $table) {
            $table->string('kategori')->nullable()->after('deskripsi');
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->integer('hari_terlambat')->default(0)->after('keterangan');
            $table->decimal('denda', 12, 0)->default(0)->after('hari_terlambat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn('kategori');
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn(['hari_terlambat', 'denda']);
        });
    }
};
