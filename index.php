<?php
// 应用目录为当前目录
define('APP_PATH', __DIR__ . '/');

// 开启调试模式
define('APP_DEBUG', true);

// 加载框架文件
require(APP_PATH . 'thinkview/Thinkview.php');

// 加载Autoload
require_once './vendor/autoload.php';

// 加载配置文件
$config = require(APP_PATH . 'config/config.php');

// 实例化框架类
(new thinkview\Thinkview($config))->run();