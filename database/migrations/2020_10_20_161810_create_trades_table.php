<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trades', function (Blueprint $table) {
            $table->id();
            $table->decimal('price_at_order', 8, 2);
            $table->string('ticker', 100);
            $table->string('beta', 100);
            $table->string('volAvg', 100);
            $table->string('changes', 100);
            $table->string('range', 100);
            $table->decimal('amount', 8, 2);
            $table->boolean('sellOrBuy');
            $table->boolean('tradeClosed');
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
        Schema::dropIfExists('trades');
    }
}
