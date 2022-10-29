<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::create('debits', function (Blueprint $table) {
            $table->id();
            $table->date("tanggal");
            $table->integer("total_harga")->default("0");
            $table->integer("total_barang")->default("0");
            $table->integer("terbayar")->default("0");
            $table->integer("kekurangan")->default("0");
            $table->foreignId("reseller_id")->nullable()->constrained("resellers");
            $table->foreignId("user_id")->constrained("users");
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('debits');
    }
};
