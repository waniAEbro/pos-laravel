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
        Schema::create('debit_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId("product_id")->constrained("products");
            $table->integer("harga");
            $table->integer("jumlah");
            $table->foreignId("debit_id")->constrained("debits");
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
        Schema::dropIfExists('debit_products');
    }
};
