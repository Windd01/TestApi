<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('source_id');
            $table->integer('clicks')->default(0);
            $table->integer('reach')->default(0);
            $table->string('cpm');
            $table->string('cpc');
            $table->string('ctr');
            $table->string('spend');
            $table->string('impressions');
            $table->integer('account_id');
            $table->string('source_type');
            $table->date('date');
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
        Schema::dropIfExists('campaigns');
    }
}
