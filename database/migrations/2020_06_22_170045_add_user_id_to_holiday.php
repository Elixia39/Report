<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToHoliday extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Holidays', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned();

            //外部キー（ユーザーの予定表を紐づけ）
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Holidays', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
}
