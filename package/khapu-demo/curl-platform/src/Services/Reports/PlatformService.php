<?php

namespace Khapu\CurlPlatform\Services\Reports;

use Khapu\CurlPlatform\Services\BaseService;

final class PlatformService extends BaseService
{
    public function __construct(string $platformName, int $timeOut){
        parent::__construct($platformName, $timeOut);
    }
}
    