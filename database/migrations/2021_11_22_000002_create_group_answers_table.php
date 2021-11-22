<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupAnswersTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'group_answers';

    /**
     * Run the migrations.
     * @table group_answers
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('group_question_id');
            $table->unsignedBigInteger('question_id');
            $table->unsignedBigInteger('answer_id');
            $table->timestamps() ;

            $table->index("group_question_id");
            $table->index(["question_id"]);
            $table->index(["answer_id"]);

            $table->foreign('group_question_id')
                ->references('id')->on('group_questions')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');

            $table->foreign('question_id')
                ->references('id')->on('questions')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');

            $table->foreign('answer_id')
                ->references('id')->on('answers')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
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
