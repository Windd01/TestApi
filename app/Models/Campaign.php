<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $fillable = [
        'name',
        'source_id',
        'clicks',
        'reach',
        'cpm',
        'cpc',
        'ctr',
        'spend',
        'impressions',
        'account_id',
        'source_type',
        'date',
    ];
}