<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_alerts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
            $table->string('lastname');
            $table->string('firstname');
            $table->string('phone');
            $table->string('message');

            $table->timestamps();

            $table->integer('job_alerts_id')->unsigned();

            $table->foreign('job_alerts_id')
                ->references('id')->on('job_alerts')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->integer('users_id')->unsigned();

            $table->foreign('users_id')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_alert');
    }
};
