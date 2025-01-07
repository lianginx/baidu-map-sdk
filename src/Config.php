<?php

namespace BaiduMapSdk;

class Config
{

    private static $apiKey;


    public static function setApiKey(string $key)
    {
        self::$apiKey = $key;
    }

    public static function getApiKey(): ?string
    {
        if (!self::$apiKey) {
            throw new \Exception("AK 未设置，请使用 Config::setApiKey() 设置您的百度地图 API Key");
        }
        return self::$apiKey;
    }

}