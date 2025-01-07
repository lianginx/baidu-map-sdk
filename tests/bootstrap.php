<?php

include_once __DIR__ . '/../vendor/autoload.php';

// 从 .env 读取项目环境变量
$filePath = __DIR__ . '/../.env';
if (!file_exists($filePath)) {
    throw new RuntimeException("Env file not found at $filePath");
}

// 写入环境变量, 以便可以通过 getenv() 获取
$lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
foreach ($lines as $line) {
    // 跳过注释行
    if (strpos(trim($line), '#') === 0) {
        continue;
    }

    // 解析 KEY=VALUE
    [$key, $value] = explode('=', $line, 2);
    $key = trim($key);
    $value = trim($value);

    // 设置环境变量（避免覆盖已有值）
    if (!getenv($key)) {
        putenv("$key=$value");
    }
}
