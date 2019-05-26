<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCoverImageToPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) { 
            $table->string('cover_image')->nullable(); //add id to our table post in database
            //must add nullable() if u want to add to column an existing table
            //$table->string('cover_image'); //default it cant be nullabale so u have to delete tables in database
        });

        //when we submit
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColum( 'cover_image');
        });
    }
}
