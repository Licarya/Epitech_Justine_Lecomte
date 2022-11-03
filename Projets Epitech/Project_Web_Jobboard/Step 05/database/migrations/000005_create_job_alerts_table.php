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
        Schema::create('job_alerts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('job_type');
            $table->longText('content');
            $table->string('secteur')->nullable();
            $table->float('wage')->nullable();
            $table->string('wage_type')->nullable();
            $table->timestamps();

            $table->integer('companies_id')->unsigned();

            $table->foreign('companies_id')
                ->references('id')->on('companies')
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
        Schema::dropIfExists('job_alerts');
    }
};
