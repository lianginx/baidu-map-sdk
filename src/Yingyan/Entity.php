<?php

namespace BaiduMapSdk\Yingyan;

use BaiduMapSdk\Applition;
use BaiduMapSdk\Enum\Yingyan\EntityEnum;

/**
 * 终端管理
 * @link https://lbsyun.baidu.com/faq/api?title=yingyan/api/v3/entity
 */
class Entity extends Applition
{
    /**
     * 添加终端
     * @param $service_id 服务ID
     * @param $entity_name 终端名称，作为其唯一标识
     * @param $entity_desc 终端描述
     * @param $column_key 开发者自定义字段
     * @link https://lbsyun.baidu.com/faq/api?title=yingyan/api/v3/entity#add%E2%80%94%E2%80%94%E6%B7%BB%E5%8A%A0entity
     */
    public function add(
        string $entity_name,
        string $entity_desc = null,
        int $service_id = null,
        ...$column_key
    ): void {
        $params = [
            'ak' => $this->getAK(),
            'service_id' => $service_id ?? $this->getDefaultServiceId(),
            'entity_name' => urlencode($entity_name),
        ];
        if ($entity_desc !== null) {
            $params['entity_desc'] = urlencode($entity_desc);
        }
        if ($service_id === null) {
            $params['service_id'] = $this->getDefaultServiceId();
        }
        $params = array_merge($params, $column_key);
        new Client(
            EntityEnum::ADD_METHOD,
            EntityEnum::ADD,
            [
                'form_params' => $params,
            ],
        );
    }

    /**
     * 更新终端
     * @param $service_id 服务ID
     * @param $entity_name 终端名称，作为其唯一标识
     * @param $entity_desc 终端描述
     * @param $column_key 开发者自定义字段
     * @link https://lbsyun.baidu.com/faq/api?title=yingyan/api/v3/entity#update%E2%80%94%E2%80%94%E6%9B%B4%E6%96%B0entity
     */
    public function update(
        string $entity_name,
        string $entity_desc = null,
        int $service_id = null,
        ...$column_key
    ): void {
        $params = [
            'ak' => $this->getAK(),
            'service_id' => $service_id ?? $this->getDefaultServiceId(),
            'entity_name' => urlencode($entity_name),
        ];
        if ($entity_desc !== null) {
            $params['entity_desc'] = urlencode($entity_desc);
        }
        $params = array_merge($params, $column_key);
        new Client(
            EntityEnum::UPDATE_METHOD,
            EntityEnum::UPDATE,
            [
                'form_params' => $params,
            ],
        );
    }

    /**
     * 删除终端
     * @param $service_id 服务ID
     * @param $entity_name 终端名称，作为其唯一标识
     * @link https://lbsyun.baidu.com/faq/api?title=yingyan/api/v3/entity#delete%E2%80%94%E2%80%94%E5%88%A0%E9%99%A4entity
     */
    public function delete(
        string $entity_name,
        int $service_id = null
    ) {
        $params = [
            'ak' => $this->getAK(),
            'service_id' => $service_id ?? $this->getDefaultServiceId(),
            'entity_name' => urlencode($entity_name),
        ];
        new Client(
            EntityEnum::DELETE_METHOD,
            EntityEnum::DELETE,
            [
                'form_params' => $params,
            ],
        );
    }

    /**
     * 查询终端
     * @param $service_id 服务ID
     * @param $filter 过滤条件: entity_names/active_time/inactive_time/开发者自定义字段
     * @param $coord_type_output 返回结果的坐标类型: bd09ll - 百度经纬度坐标/gcj02 - 国测局加密坐标
     * @param $page_index 分页索引
     * @param $page_size 分页大小
     * @link https://lbsyun.baidu.com/faq/api?title=yingyan/api/v3/entity#list%E2%80%94%E2%80%94%E6%9F%A5%E8%AF%A2entity
     */
    public function list(
        array $filter = null,
        string $coord_type_output = 'bd09ll',
        int $page_index = 1,
        int $page_size = 100,
        int $service_id = null
    ) {
        $params = [
            'ak' => $this->getAK(),
            'service_id' => $service_id ?? $this->getDefaultServiceId(),
            'coord_type_output' => urlencode($coord_type_output),
            'page_index' => $page_index,
            'page_size' => $page_size,
        ];
        if ($filter !== null) {
            foreach ($filter as $key => $value) {
                $next_filter[] = "$key:$value";
            }
            $params['filter'] = implode('|', $next_filter);
        }
        $client = new Client(
            EntityEnum::LIST_METHOD,
            EntityEnum::LIST ,
            [
                'query' => $params,
            ],
        );
        return $client->toArray();
    }
}
