<?php

namespace BaiduMapSdk\Yingyan;

use BaiduMapSdk\Http\BaseRequest;
use BaiduMapSdk\Enum\Yingyan\YingyanEnum;

class Client extends BaseRequest
{

    protected string $baseUrl = YingyanEnum::BASE_URL;

}
