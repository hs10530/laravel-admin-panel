<?php

use Illuminate\Database\Migrations\Migration;

class CreateCategoryContentJoinTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('category_content', function($table)
		{
			$table->increments('id');
			$table->integer('category_id')->unsigned();
			$table->integer('content_id')->unsigned();
			$table->timestamps();

			$table->unique(array('category_id','content_id'));

			$table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
			$table->foreign('content_id')->references('id')->on('contents')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('category_content');
	}

}