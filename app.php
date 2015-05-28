<?php

use BEAR\Package\Bootstrap;
use Doctrine\Common\Annotations\AnnotationRegistry;

/** @var $loader \Composer\Autoload\ClassLoader */
$loader = require __DIR__ . '/vendor/autoload.php';
AnnotationRegistry::registerLoader([$loader, 'loadClass']); // アノテーションのロード

$app = (new Bootstrap)->getApp('MyVendor\Weekday', 'prod-hal-app'); // アプリケーションの取得
$import = $app->resource->get->uri('app://self/import')->request();

echo $import['blog'] . PHP_EOL;
