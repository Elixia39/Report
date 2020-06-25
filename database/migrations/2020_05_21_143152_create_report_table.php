<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('folder_id')->unsigned();
            $table->date('report_date')->comment("日付");
            $table->integer('temperature')->unsigned()->nullable()->comment("体温");
            $table->integer('am_condition')->unsigned()->nullable()->comment("午前の体調");
            $table->integer('pm_condition')->unsigned()->nullable()->comment("午後の体調");
            $table->string('medicines', 100)->comment("服薬");
            $table->text('condition_report')->nullable()->comment("体調で気になること");
            $table->string('curricilum1', 25)->comment("カリキュラム");
            $table->string('contant1', 100)->nullable()->comment("内容");
            $table->string('curricilum2', 25)->comment("カリキュラム2");
            $table->string('contant2', 100)->nullable()->comment("内容2");
            $table->text('impressions')->nullable()->comment("感想");
            $table->dateTime('interview')->nullable()->comment("面談希望日");
            $table->text('contact_information')->nullable()->comment("連絡事項");
            $table->timestamps();

            //外部キー
            $table->foreign('folder_id')->references('id')->on('folders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
}
