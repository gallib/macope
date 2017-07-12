<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('type_category_id')->unsigned();
            $table->timestamps();

            $table->foreign('type_category_id')->references('id')->on('type_categories');
        });

        Schema::table('journal_entries', function (Blueprint $table) {
           $table->integer('category_id')->nullable()->unsigned()->after('balance');

           $table->foreign('category_id')->references('id')->on('categories');
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
