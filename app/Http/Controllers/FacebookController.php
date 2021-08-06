<?php

namespace App\Http\Controllers;

use App\Models\Campaign;

class FacebookController extends Controller
{

    // Lấy all campaigns trong tài khoản đợợc cho
    //226431449351589|tefRXhPXOFpyo4xzlaGqqIghgzo

    public function index()
    {
        $data = json_decode($this->getCampaigns());
        foreach($data->data as $campaign) {
            $input = [
                'name' => $campaign->name,
                'channel_id' => $campaign->id,
                'effective_status' => $campaign->effective_status,
                'objective' => $campaign->objective
            ];
            // dd($campaign, $input);

            Campaign::create($input);
        }
    }
    // Lấy toàn bộ thông tin của tài khoản đợợc cho
    public function account()
    {
        $data = json_decode($this->getAccount());
        dd($data);
    }
    // Lấy thông tin của các ad với các điều kiện được input search vào
    public function insight()
    {
        $data = json_decode($this->getInsight());
        dd($data);
    }
    function getCampaigns()
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://graph.facebook.com/v11.0/act_215291933075430/campaigns?fields=name,insights,effective_status,objective,total_count&time_range=%7B%22since%22:%222019-10-01%22,%22until%22:%222020-10-01%22%7D',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer EAAFxHGbIZBAcBANpGZBZCr4wXcnWJODnPt6JQ9u9hsEjKL1bF1UtokNAnyaUQyRSxINNrJlXKgIPitL1BnyYHbs8W0owHv1LfUHPn8TEZAZCODqpXjRdOSG1YTexTMG3VQV4TVbNIm9FDq4VDBgIZCO7gZAvkdHul788mjWY42kctpIzIF54gDY'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }
    function getAccount()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://graph.facebook.com/v11.0/act_215291933075430?fields=name,account_status,amount_spent,balance,disable_reason,min_daily_budget,min_campaign_group_spend_cap,spend_cap',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer EAACSPvnGMgcBAAh5THkHjiqiIiVWo0u29Q8AAHOZCQzDDIZB7Mawownf4kZBBlw2lx1ojFNUaEMP4EnddyXfnaMLu0CcwqG5qABnKZBkp6xZANM3vB5ndtD0eLume1LcZAzuVZAewjT6QHMmZCcZBb8StKvmrUmRZCnUbnVEwUqLR1TZBH2ZBRjlly5c'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }
    function getInsight()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://graph.facebook.com/v11.0/23844819598520694/insights?fields=account_currency,account_id,account_name,action_values,clicks,reach,cpm,cpc,ctr,spend,campaign_name,canvas_avg_view_time,conversions,conversion_values,cost_per_ad_click,cost_per_conversion,impressions&date_preset=last_year&time_increment=1&time_range=%7B%22since%22:%222020-05-15%22,%22until%22:%222020-05-17%22%7D',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer EAACSPvnGMgcBAAh5THkHjiqiIiVWo0u29Q8AAHOZCQzDDIZB7Mawownf4kZBBlw2lx1ojFNUaEMP4EnddyXfnaMLu0CcwqG5qABnKZBkp6xZANM3vB5ndtD0eLume1LcZAzuVZAewjT6QHMmZCcZBb8StKvmrUmRZCnUbnVEwUqLR1TZBH2ZBRjlly5c'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }
}