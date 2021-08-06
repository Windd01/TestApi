<?php

namespace Khapu\CurlPlatform\Services\Reports;

use Khapu\CurlPlatform\Services\Reports\PlatformService;

class FacebookService 
{
    private $_config;
    
    private $_platformService;

    public function __construct()
    {
        $this->_platformService = new PlatformService('facebook',30);

    }

    public function getInsight(array $params, array $tokens, array $query)
    {
        $response = $this->_platformService->query($query)
                                        ->slug('insights', $params)
                                        ->token($tokens)
                                        ->get();
        return $response;
    }

    public function getAccount(array $params, array $tokens, array $query)
    {
        $response = $this->_platformService->slug('account', $params)
                                        ->token($tokens)
                                        ->query($query)
                                        ->get();
        return $response;
    }

    public function getAds(array $params, array $tokens, array $query)
    {
        $response = $this->_platformService->slug('ads', $params)
                                        ->token($tokens)
                                        ->query($query)
                                        ->get();
        return $response;
    }

    public function getCampaigns($params, $tokens, $fields)
    {
        return $this->_baseService
            ->getSlug('campaigns', $params)
            ->getToken($tokens)
            ->getField($fields)
            ->get();
    }

    public function getLongTimeToken($fields)
    {
        $response = $this->_baseService->getSlug('long_time_token')
                                        ->getField($fields)
                                        ->get();
        return $response;
    }
}