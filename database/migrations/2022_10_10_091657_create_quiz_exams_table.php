<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_exams', function (Blueprint $table) {
            $table->id();
            $table->efficientUuid('uuid')->index();
            $table->string("name")->nullable()->default("Quiz");
            $table->foreignId("student_id");
            $table->foreignId("chapters_id");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quiz_exams');
    }
}
