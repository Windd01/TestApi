<?php

namespace Khapu\CurlPlatform\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Controllers;
use App\Models\Account;
use Illuminate\Http\Request;
use Khapu\CurlPlatform\Services\Reports\FacebookService;

class TestController extends Controller
{

    protected $facebookService;

    public function __construct(FacebookService $facebookService)
    {
        $this->facebookService = $facebookService;
    }


    // lấy thông tin của một campagin
    public function index()
    {

        $fields = [
            'fields' => 'account_currency,account_id,account_name,action_values,clicks,reach,cpm,cpc,ctr,spend,campaign_name,canvas_avg_view_time,conversions,conversion_values,cost_per_ad_click,cost_per_conversion,impressions',
            'date_preset' => 'last_year'
        ];
        // $fields = [
        //     'client_id' => '405841774180359',
        //     'client_secret' => '4fd840ec3ffb2a7b55d5c60a5732191b',
        //     'fb_exchange_token' => 'EAAFxHGbIZBAcBANpBT46QvWKPfZCTGTC3ehZBpDbmFkclyQarmEsH1MM74T38uFwtmFq27HQDQAILPZCWsc2Fx9rZCUFYhV69QufDIyfSYrtPNPUAJEs9BHga4F265ENGe8ogUZB4jDgRRZCQZAuoGL6Ri79RWvv8ZCagyZAc3ozNWQQZDZD',
        //     'grant_type' => 'fb_exchange_token'
        // ];

        $token = [
            'access_token' => 'EAAFxHGbIZBAcBAC4eMeCsaNGgMHl9toCCnYn8JDq9dnhl1DoTZAXoinTsZBnB4CiZApl3DD1EFgyZAhRNqwKo0o6e84puxZB85ERzfooKIwNobyH9O3He1YPO8aR8DNfYyBopw2Vh3aE1x9UT3GDIpBgmnciZAlaTe3Lvtr4AZAZCSgHgNgxw1F4K',
        ];

//        dd(Account::all());
        $params = ['id' => '23844819598520694'];
        // dd($testDetail->getLongTimeToken($fields));
        dd($this->facebookService->getInsight($params, $token, $fields));
    }

    // lấy thông tin của 1 account
    public function getAccount($facebookId)
    {
        $facebookAccount = Account::where('facebook_id', $facebookId)->first();
        if (!empty($facebookAccount)) {
            $fields = [
                'fields' => 'name,account_status,amount_spent,balance,disable_reason,min_daily_budget,min_campaign_group_spend_cap,spend_cap',
            ];

            $token = [
                'access_token' => $facebookAccount->access_token,
            ];

            $params = [
                'id' => $facebookId,
            ];

            dd($this->facebookService->getAccount($params, $token, $fields));
        }
    }


    // lấy thông tin danh sách ads trong account
    public function getAds($facebookId)
    {
        $facebookAccount = Account::where('facebook_id', $facebookId)->first();
        if (!empty($facebookAccount)) {
            $fields = [
                'fields' => 'name,insights,effective_status,objective,total_count',
                'time_range' => '{"since":"2019-10-01","until":"2020-10-01"}',
            ];

            $token = [
                'access_token' => $facebookAccount->access_token,
            ];

            $params = [
                'id' => $facebookId,
            ];

            dd($this->facebookService->getAds($params, $token, $fields));
        }
    }
}