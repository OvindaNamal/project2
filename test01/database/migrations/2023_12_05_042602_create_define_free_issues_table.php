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
        Schema::create('define_free_issues', function (Blueprint $table) {
            $table->id();
        $table->text("label");
        $table->text("type");
        $table->integer("product_code"); // Assuming this is the foreign key
        $table->text("pu_product");
        $table->text("product_price");
        $table->text("free_product");
        $table->integer("pu_quantity");
        $table->integer("free_quantity");
        $table->integer("lower_limit");
        $table->integer("upper_limit");
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
        Schema::dropIfExists('define_free_issues');
    }
};
