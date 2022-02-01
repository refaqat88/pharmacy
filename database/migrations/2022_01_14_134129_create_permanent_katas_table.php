<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermanentKatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permanent_katas', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsiged()->index();
            $table->string('address');
            $table->date('current_date');
            $table->string('receipt_no')->nullable();
            $table->string('total_amount')->default(0);
            $table->string('remaining_amount');
            $table->string('paid_amount');
            $table->date('paid_date');
            $table->enum('amount_status', ['Paid','Bill']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permanent_katas');
    }
}
