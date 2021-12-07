<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlertsTable extends Migration
{

    public function up()
    {
        Schema::create('alerts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger("item_id")->unsigned();
            $table->double("max_price");
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('item_id')->references('id')->on('items');
        });
    }


    public function down()
    {
        Schema::dropIfExists('alerts');
    }
}
