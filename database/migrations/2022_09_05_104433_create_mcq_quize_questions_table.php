<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMcqQuizeQuestionsTable extends Migration
{
    public $tableName= 'mcq_quize_questions';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine ='InnoDB';
            $table->id();
            $table->string('name');
            $table->boolean('status');
            $table->string('question')->nullable();
            $table->string('answer')->nullable();
            $table->text('option')->nullable();
            $table->foreignId('mcq_quizes_id')->index()->constrained();
            $table->foreignId('mcq_quizes_chapters_id')->index();
            $table->foreignId('mcq_quizes_chapters_subjects_id')->index();
            $table->foreignId('mcq_q_c_s_classes_id')->index();
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
        Schema::dropIfExists($this->tableName);
    }
}
