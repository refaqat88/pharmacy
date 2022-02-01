<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdminIdToKatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('katas', function (Blueprint $table) {

                $table->bigInteger('admin_id')->unsigned()->index();
                $table->foreign('admin_id')->references('id')->on('users')->onDelete('cascade');;


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('katas', function (Blueprint $table) {
          $table->dropColumn('admin_id');
        });
    }
}
