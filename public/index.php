<?php
require dirname(__DIR__) . '/autoload.php';
exit((require dirname(__DIR__) . '/bootstrap.php')(PHP_SAPI === 'cli-server' ? 'html-app' : 'prod-html-app'));
