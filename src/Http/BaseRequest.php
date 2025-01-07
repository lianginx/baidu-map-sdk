<?php

namespace BaiduMapSdk\Http;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use BaiduMapSdk\Exception\BaiduMapSdkException;

class BaseRequest
{

    protected string $baseUrl;
    protected int $timeout = 10;

    private string $url;
    private string $method;
    private array $options;

    protected Client $client;
    protected ResponseInterface $response;

    protected string $result;
    protected array $arrayResult;

    public function __construct(string $method, string $url, array $options = [])
    {
        $this->url = $url;
        $this->method = $method;
        $this->options = $options;

        $this->client = new Client([
            'base_uri' => $this->baseUrl,
            'timeout' => $this->timeout,
        ]);

        $this->response = $this->client->request($method, $url, $options);
        $this->result = $this->response->getBody()->getContents();
        $this->arrayResult = json_decode($this->result, true);

        // API 错误抛出异常
        if (!isset($this->options['throw_api_error']) || $this->options['throw_api_error'] === true) {
            if ($this->arrayResult['status'] != 0) {
                throw new BaiduMapSdkException(
                    $this->arrayResult['message'],
                    $this->arrayResult['status']
                );
            }
        }
    }

    public function toString(): string
    {
        return $this->result;
    }

    public function __tostring(): string
    {
        return $this->result;
    }

    public function toArray(): array
    {
        return $this->arrayResult;
    }

}