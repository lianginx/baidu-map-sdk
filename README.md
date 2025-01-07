# 百度地图 SDK for PHP

[![GitHub License](https://img.shields.io/github/license/lianginx/baidu-map-sdk)](https://github.com/lianginx/baidu-map-sdk/blob/main/LICENSE) [![Packagist Version](https://img.shields.io/packagist/v/lianginx/baidu-map-sdk)](https://packagist.org/packages/lianginx/baidu-map-sdk) [![GitHub Repo stars](https://img.shields.io/github/stars/lianginx/baidu-map-sdk)](https://github.com/lianginx/baidu-map-sdk)

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

## 安装

```bash
composer require lianginx/baidu-map-sdk
```

## 使用

```php
$ak = 'your api key';
$default_service_id = 123456;

$entity = new Entity($ak, $default_service_id);
$entity_name = 'test_entity';

// 新增终端
$entity->add($entity_name);

// 更新终端
$entity->update($entity_name, 'hello world');

// 删除终端
$entity->delete($entity_name);

// 其他接口...
```

## 许可证

[MIT](LICENSE)
