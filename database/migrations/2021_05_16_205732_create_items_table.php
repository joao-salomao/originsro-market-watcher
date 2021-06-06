<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger("item_id");
            $table->text("unique_name");
            $table->text("name");
            $table->text("type");
            $table->text("subtype")->nullable();
            $table->integer('slots')->nullable();
            $table->double("npc_price");
            $table->longText("icon")->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('items');
    }
}
