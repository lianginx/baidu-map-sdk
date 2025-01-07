<?php

namespace BaiduMapSdk\Yingyan;

use BaiduMapSdk\Applition;
use BaiduMapSdk\Enum\Yingyan\TrackEnum;

/**
 * 轨迹管理
 * @link https://lbsyun.baidu.com/faq/api?title=yingyan/api/v3/trackupload
 */
class Track extends Applition
{

    /**
     * 上传单个轨迹点
     * @param $service_id 服务ID
     * @param $entity_name 终端名称，如果终端不存在则自动创建
     * @param $latitude 纬度
     * @param $longitude 经度
     * @param $loc_time Unix时间戳
     * @param $coord_type_input 坐标类型: bd09ll - 百度经纬度坐标/gcj02 - 国测局加密坐标
     * @param $speed 速度(km/h)
     * @param $direction 方向(0-359)，0 为正北方
     * @param $height 高度(米)
     * @param $radius 定位精度(米)，GPS 或定位 SDK 返回的值
     * @param $object_name 通过鹰眼 SDK 上传的图像文件名称
     * @param $column_key 自定义字段
     * @link https://lbsyun.baidu.com/faq/api?title=yingyan/api/v3/trackupload#addpoint%E2%80%94%E2%80%94%E4%B8%8A%E4%BC%A0%E5%8D%95%E4%B8%AA%E8%BD%A8%E8%BF%B9%E7%82%B9
     */
    public function addPoint(
        string $entity_name,
        float $latitude,
        float $longitude,
        int $loc_time,
        string $coord_type_input = 'bd09ll',
        float $speed = null,
        int $direction = null,
        float $height = null,
        float $radius = null,
        string $object_name = null,
        int $service_id = null,
        ...$column_key
    ) {
        $params = [
            'ak' => $this->getAK(),
            'service_id' => $service_id ?? $this->getDefaultServiceId(),
            'entity_name' => urlencode($entity_name),
            'latitude' => $latitude,
            'longitude' => $longitude,
            'loc_time' => $loc_time,
            'coord_type_input' => $coord_type_input,
        ];
        if ($speed !== null) {
            $params['speed'] = $speed;
        }
        if ($direction !== null) {
            $params['direction'] = $direction;
        }
        if ($height !== null) {
            $params['height'] = $height;
        }
        if ($radius !== null) {
            $params['radius'] = $radius;
        }
        if ($object_name !== null) {
            $params['object_name'] = $object_name;
        }
        $params = array_merge($params, $column_key);
        new Client(
            TrackEnum::ADD_POINT_METHOD,
            TrackEnum::ADD_POINT,
            [
                'form_params' => $params,
            ]
        );
    }

    /**
     * 批量上传轨迹点
     * @param $service_id 服务ID
     * @param $point_list 轨迹点列表，总数不超过100个
     * @link https://lbsyun.baidu.com/faq/api?title=yingyan/api/v3/trackupload#addpoints%E2%80%94%E2%80%94%E6%89%B9%E9%87%8F%E6%B7%BB%E5%8A%A0%E8%BD%A8%E8%BF%B9%E7%82%B9
     */
    public function addPoints(
        array $point_list,
        string $service_id = null
    ): array {
        $client = new Client(
            TrackEnum::ADD_POINTS_METHOD,
            TrackEnum::ADD_POINTS,
            [
                'throw_api_error' => false,
                'form_params' => [
                    'ak' => $this->getAK(),
                    'service_id' => $service_id ?? $this->getDefaultServiceId(),
                    'point_list' => json_encode($point_list),
                ],
            ]
        );
        return $client->toArray();
    }

    /**
     * 获取终端最新轨迹点
     * @param $service_id 服务ID
     * @param $entity_name 终端名称
     * @param $process_option 纠偏选项
     * @param $coord_type_output 返回坐标类型: bd09ll - 百度经纬度坐标/gcj02 - 国测局加密坐标
     * @link https://lbsyun.baidu.com/faq/api?title=yingyan/api/v3/trackprocess#getlatestpoint%E2%80%94%E2%80%94%E5%AE%9E%E6%97%B6%E7%BA%A0%E5%81%8F
     */
    public function getLatestPoint(
        string $entity_name,
        string $process_option = 'denoise_grade=1,need_mapmatch=0,transport_mode=auto',
        string $coord_type_output = 'bd09ll',
        int $service_id = null
    ): array {
        $client = new Client(
            TrackEnum::GET_LATEST_POINT_METHOD,
            TrackEnum::GET_LATEST_POINT,
            [
                'query' => [
                    'ak' => $this->getAK(),
                    'service_id' => $service_id ?? $this->getDefaultServiceId(),
                    'entity_name' => urlencode($entity_name),
                    'process_option' => $process_option,
                    'coord_type_output' => $coord_type_output,
                ],
            ],
        );
        return $client->toArray();
    }

    /**
     * 查询轨迹里程
     * @param $service_id 服务ID
     * @param $entity_name 终端名称
     * @param $start_time 起始时间(Unix时间戳)
     * @param $end_time 结束时间(Unix时间戳)，结束时间不超过当前时间，不能早于起始时间，且与起始时间差在24小时之内
     * @param $is_processed 是否返回纠偏后里程
     * @param $process_option 纠偏选项
     * @param $supplement_mode 里程补偿方式
     * @param $low_speed_threshold 低速阈值
     * @link https://lbsyun.baidu.com/faq/api?title=yingyan/api/v3/trackprocess#getdistance%E2%80%94%E2%80%94%E6%9F%A5%E8%AF%A2%E8%BD%A8%E8%BF%B9%E9%87%8C%E7%A8%8B
     */
    public function getDistance(
        string $entity_name,
        int $start_time,
        int $end_time,
        bool $is_processed = false,
        string $process_option = 'denoise_grade=1,need_mapmatch=0,transport_mode=auto',
        string $supplement_mode = 'no_supplement',
        float $low_speed_threshold = null,
        string $service_id = null
    ): array {
        $params = [
            'ak' => $this->getAK(),
            'service_id' => $service_id ?? $this->getDefaultServiceId(),
            'entity_name' => urlencode($entity_name),
            'start_time' => $start_time,
            'end_time' => $end_time,
            'is_processed' => (string) (int) $is_processed,
            'process_option' => $process_option,
            'supplement_mode' => $supplement_mode,
        ];
        if ($low_speed_threshold !== null) {
            $params['low_speed_threshold'] = $low_speed_threshold;
        }
        $client = new Client(
            TrackEnum::GET_DISTANCE_METHOD,
            TrackEnum::GET_DISTANCE,
            [
                'query' => $params,
            ],
        );
        return $client->toArray();
    }

    /**
     * 轨迹查询与纠偏
     * @param $service_id 服务ID
     * @param $entity_name 终端名称
     * @param $start_time 起始时间(Unix时间戳)
     * @param $end_time 结束时间(Unix时间戳)，结束时间不超过当前时间，不能早于起始时间，且与起始时间差在24小时之内
     * @param $is_processed 是否返回纠偏后里程
     * @param $process_option 纠偏选项
     * @param $supplement_mode 轨迹补偿交通方式选择
     * @param $supplement_content 轨迹补偿内容
     * @param $low_speed_threshold 低速阈值
     * @param $coord_type_output 返回的坐标类型
     * @param $sort_type 返回轨迹点的排序规则
     * @param $page_index 分页索引
     * @param $page_size 分页大小
     */
    public function getTrack(
        string $entity_name,
        int $start_time,
        int $end_time,
        bool $is_processed = false,
        string $process_option = 'denoise_grade=1,need_mapmatch=0,transport_mode=auto',
        string $supplement_mode = 'no_supplement',
        string $supplement_content = 'only_distance',
        float $low_speed_threshold = null,
        string $coord_type_output = 'bd09ll',
        string $sort_type = 'asc',
        int $page_index = 1,
        int $page_size = 100,
        string $service_id = null
    ): array {
        $params = [
            'ak' => $this->getAK(),
            'service_id' => $service_id ?? $this->getDefaultServiceId(),
            'entity_name' => urlencode($entity_name),
            'start_time' => $start_time,
            'end_time' => $end_time,
            'is_processed' => (string) (int) $is_processed,
            'process_option' => $process_option,
            'supplement_mode' => $supplement_mode,
            'supplement_content' => $supplement_content,
            'coord_type_output' => $coord_type_output,
            'sort_type' => $sort_type,
            'page_index' => $page_index,
            'page_size' => $page_size,
        ];
        if ($low_speed_threshold !== null) {
            $params['low_speed_threshold'] = $low_speed_threshold;
        }
        $client = new Client(
            TrackEnum::GET_TRACK_METHOD,
            TrackEnum::GET_TRACK,
            [
                'query' => $params,
            ],
        );
        return $client->toArray();
    }

}