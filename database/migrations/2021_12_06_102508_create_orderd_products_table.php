<?php

use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderdProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orderd_products', function (Blueprint $table) {
            $table->id();
            $table->integer("amount");
            $table->foreignIdFor(Product::class);
            $table->foreignIdFor(Invoice::class);
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
        Schema::dropIfExists('orderd_products');
    }
}
