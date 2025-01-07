<?php

namespace BaiduMapSdk;

use BaiduMapSdk\Exception\BaiduMapSdkException;

abstract class Applition
{

    private string $ak;
    private int $defaultServiceId;

    public function __construct(string $ak, int $default_service_id)
    {
        if (empty($ak)) {
            throw new BaiduMapSdkException('ak 不能为空');
        }
        if (empty($default_service_id)) {
            throw new BaiduMapSdkException('default_service_id 不能为空');
        }
        $this->ak = $ak;
        $this->defaultServiceId = $default_service_id;
    }

    /**
     * 获取应用 AK
     */
    public function getAK(): string
    {
        return $this->ak;
    }

    /**
     * 获取默认鹰眼轨迹服务ID
     */
    public function getDefaultServiceId(): int
    {
        return $this->defaultServiceId;
    }

}