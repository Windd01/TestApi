<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = [
        'facebook_id',
        'name',
        'account_status',
        'amount_spent',
        'balance',
        'disable_reason',
        'min_daily_budget',
        'min_campaign_group_spend_cap',
        'spend_cap',
        'access_token',
        'fb_exchange_token',
        'client_id',
        'client_secret',
        'channel_id',
    ];
}