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
        Schema::table('transactions', function (Blueprint $table) {
            $table->string('order_id')->nullable()->after('id'); // 1. Tambah kolom tanpa unique
        });

        // 2. Isi data lama dengan nilai unik
        foreach (\App\Models\Transaction::whereNull('order_id')->get() as $transaction) {
            $transaction->update(['order_id' => 'ORD-' . \Illuminate\Support\Str::upper(\Illuminate\Support\Str::random(10))]);
        }

        // 3. Tambahkan constraint unique setelah data terisi
        Schema::table('transactions', function (Blueprint $table) {
            $table->unique('order_id');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            //
        });
    }
};
