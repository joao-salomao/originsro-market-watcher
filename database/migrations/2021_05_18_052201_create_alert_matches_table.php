<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlertMatchesTable extends Migration
{
    public function up()
    {
        Schema::create('alert_matches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('alert_id')->unsigned();
            $table->text("shop_name");
            $table->text("owner_name");
            $table->integer('amount');
            $table->text("map");
            $table->integer("location_x");
            $table->integer("location_y");
            $table->timestamps();

            $table->foreign('alert_id')->references('id')->on('alerts');
        });
    }

    public function down()
    {
        Schema::dropIfExists('alert_matches');
    }
}
