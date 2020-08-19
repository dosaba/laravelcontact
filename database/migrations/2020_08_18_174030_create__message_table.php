<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
	    $table->text('body')->nullable();
	    $table->string('fromName')->nullable();
	    $table->string('fromEmail')->nullable();
	    $table->string('toEmail')->nullable();
	    $table->float('spamScore')->nullable();
	    $table->foreignId('subjectId');
	    $table->foreign('subjectId')->references('id')->on('subjects');
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
        Schema::dropIfExists('_message');
    }
}
