# 百度地图 SDK for PHP

出于工作需要对百度地图开放 API 进行封装，封装结构简单易懂，有暂未实现的接口或需要改进的地方欢迎提交 PR。

## 支持的接口

- [ ] Web 服务 API
- [ ] 鹰眼轨迹服务
  - [X] 终端管理
  - [ ] 空间搜索
  - [X] 轨迹上传
  - [X] 轨迹查询和纠偏
  - [ ] 轨迹分析
  - [ ] 地理围栏管理
  - [ ] 地理围栏报警

## 使用

```php
// 设置 API Key, 全局仅需设置一次
Config::setApiKey('your api key');

// 新增终端
$service_id = 1234567;
$entity_name = 'test_entity';
Entity::add($service_id, $entity_name);

// 其他接口...
```

## 许可证

[MIT](LICENSE)