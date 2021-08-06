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
            $table->string('facebook_id')->nullable()->unique();
            $table->string('name')->nullable();
            $table->integer('account_status')->nullable();
            $table->integer('amount_spent')->nullable();
            $table->integer('balance')->nullable();
            $table->integer('disable_reason')->nullable();
            $table->integer('min_daily_budget')->nullable();
            $table->string('min_campaign_group_spend_cap')->nullable();
            $table->string('spend_cap')->nullable();
            $table->string('access_token');
            $table->string('fb_exchange_token');
            $table->string('client_id');
            $table->string('client_secret');
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
