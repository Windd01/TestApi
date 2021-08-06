<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Campaign;
use Illuminate\Support\Facades\Log;

class SyncCampaignsFacebook implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $facebookAccount;
    protected $facebookId;

    public function __construct($facebookAccount, $facebookId)
    {
        $this->facebookAccount = $facebookAccount;
        $this->facebookId = $facebookId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $fields = [
            'fields' => 'name,insights,effective_status,objective,total_count',
        ];

        $token = [
            'access_token' => $this->facebookAccount->access_token,
        ];

        $params = [
            'id' => $this->facebookId,
        ];
        $facebookService = new FacebookService();

        $dataCampaigns = $facebookService->getCampaigns($params, $token, $fields);

        if(empty($dataCampaigns->error)) {
            foreach($dataCampaigns->data as $campaign)
            {
                $campaignModel = Campaign::where('source_id', $campaign->id)->first();
                if(empty($campaignModel)) {
                    $insightFields = [
                        'fields' => 'account_currency,account_id,account_name,action_values,clicks,reach,cpm,cpc,ctr,spend,campaign_name,canvas_avg_view_time,conversions,conversion_values,cost_per_ad_click,cost_per_conversion,impressions',
                        'time_increment' => '1',
                        'date_preset' => 'maximum',
                    ];
                    $params = ['id' => $campaign->id];
                    $detailCampaign = $facebookService->getInsight($params, $token, $insightFields);
                    if(empty($detailCampaign->error)) {
                        foreach($detailCampaign->data as $campaignByDate) {
                            $checkCampaignByDate = Campaign::where('source_id', $campaign->id)->where('date', $campaignByDate->date_start)->first();
                            if(empty($checkCampaignByDate)) {
                                $inputCampaign = [
                                    'source_id' => $campaign->id,
                                    'name' => $campaignByDate->campaign_name ?? '',
                                    'clicks' => $campaignByDate->clicks ?? '',
                                    'reach' => $campaignByDate->reach ?? '',
                                    'cpm' => $campaignByDate->cpm ?? '',
                                    'cpc' => $campaignByDate->cpc ?? '',
                                    'ctr' => $campaignByDate->ctr ?? '',
                                    'spend' => $campaignByDate->spend ?? '',
                                    'impressions' => $campaignByDate->impressions ?? '',
                                    'date' => $campaignByDate->date_start ?? '',
                                    'account_id' => 1,
                                    'source_type' => 'facebook',
                                ];

                                $newCampaign = Campaign::create($inputCampaign);
                            }
                        }

                    }
                }
            }
            Log::info('done job');
        }

    }
}
