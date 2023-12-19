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
        Schema::create('placing_orders', function (Blueprint $table) {
            $table->id();
            $table->text("customer_name");
            $table->integer("order_No");
            $table->text("pu_product");
            $table->integer("product_code"); // Assuming this is the foreign key
            $table->text("product_price");
            $table->integer("quantity");
            $table->integer("free");
            $table->integer("discount");
            $table->integer("amount");
            $table->integer("net_Amount"); // mean sun total amount
            $table->integer("tot_discount");
            $table->integer("tot_Amount");
            $table->integer("pay");
            $table->integer("balance");
            $table->timestamps();
    
            // Define the foreign key constraint
            // $table->foreign('product_code')->references('product_code')->on('define_free_issues');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('placing_orders');
    }
};
