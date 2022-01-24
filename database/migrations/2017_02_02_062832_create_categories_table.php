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
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->boolean('is_ignored')->default(0);
            $table->integer('type_category_id')->unsigned();
            $table->timestamps();
            $table->foreign('type_category_id')->references('id')->on('type_categories');
        });
        Schema::table('journal_entries', function (Blueprint $table) {
            $table->integer('category_id')->nullable()->unsigned()->after('debit');
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
};
