<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCardInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_card_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('card_number')->unique();
            $table->string('pin_no')->nullable()->comment('changeable');
            $table->double('balance')->default(0);
            $table->tinyInteger('status')->default(1)->comment('1 = active', '2 = inactive');
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
        Schema::dropIfExists('user_card_infos');
    }
}
