<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Khapu\CurlPlatform\Services\Reports\FacebookService;
use App\Models\Campaign;
use Illuminate\Support\Facades\Log;

class SyncAccountFacebook implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $facebookAccount;
    protected $facebookId;

    public function __construct($facebookAccount, $facebookId)
    {
        $this->facebookAccount = $facebookAccount;
        $this->facebookId = $facebookId;
    }

    public function handle()
    {
        $fields = [
            'fields' => 'name,account_status,amount_spent,balance,disable_reason,min_daily_budget,min_campaign_group_spend_cap,spend_cap',
        ];

        $token = [
            'access_token' => $this->facebookAccount->access_token,
        ];

        $params = [
            'id' => $this->facebookId,
        ];
        $facebookService = new FacebookService();
        $dataAccount = $facebookService->getAccount($params, $token, $fields);

        if(empty($dataAccount->error)) {
            $inputAccount = [
                'name' => $dataAccount->name,
                'account_status' => $dataAccount->account_status,
                'amount_spent' => $dataAccount->amount_spent,
                'balance' => $dataAccount->balance,
                'disable_reason' => $dataAccount->disable_reason,
                'min_daily_budget' => $dataAccount->min_daily_budget,
                'min_campaign_group_spend_cap' => $dataAccount->min_campaign_group_spend_cap,
                'spend_cap' => $dataAccount->spend_cap,
            ];

            $this->facebookAccount->update($inputAccount);
        }

        dispatch( new SyncCampaignsFacebook($this->facebookAccount, $this->facebookId))->onQueue('facebook');

    }
}
