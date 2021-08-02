<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('facebook_id')->unique();
            $table->string('name');
            $table->integer('account_status');
            $table->integer('amount_spent');
            $table->integer('balance');
            $table->integer('disable_reason');
            $table->integer('min_daily_budget');
            $table->string('min_campaign_group_spend_cap');
            $table->string('spend_cap');
            $table->string('refresh_token');
            $table->string('develop_token');
            $table->string('access_token');
            $table->integer('channel_id');
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
        Schema::dropIfExists('accounts');
    }
}
