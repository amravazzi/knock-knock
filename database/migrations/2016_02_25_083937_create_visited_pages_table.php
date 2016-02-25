<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitedPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('visited_pages', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('user_id')->unsigned();
          $table->integer('page_id')->unsigned();
          $table->timestamps();
      });

      Schema::table('visited_pages', function($table) {
          $table->foreign('user_id')->references('id')->on('users');
          $table->foreign('page_id')->references('id')->on('pages');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropForeign('pages_user_id_foreign');
        Schema::drop('visited_pages');
    }
}
