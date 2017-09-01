<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSlugToPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('posts', function($table){
            // Create unique index for each item, helps with speed of queries and identifying slug searches.
            // After command instructs location of column in existing table. IN MySql
            $table->string('slug')->unique()->after('body');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Part 22 talk about the neccessary updates for dropping columns.
        Schema::table('posts', function(){
            $table->dropColumn('slug');
        });
    }
}
