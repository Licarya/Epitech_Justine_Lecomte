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
        Schema::create('links', function (Blueprint $table) {
            $table->increments('id');
            $table->string('link_linkedin')->nullable();
            $table->string('link_github')->nullable();
            $table->string('link_website')->nullable();
            $table->string('link_other')->nullable();
            $table->timestamps();

            $table->integer('users_id')->unsigned();
            // $table->index('users_id');

            $table->foreign('users_id')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->integer('companies_id')->unsigned();
            // $table->index('companies_id');

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
        Schema::dropIfExists('link');
    }
};
