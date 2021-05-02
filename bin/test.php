<?php

declare(strict_types=1);

use MyVendor\Weekday\Bootstrap;

require dirname(__DIR__) . '/autoload.php';
exit((new Bootstrap())(PHP_SAPI === 'cli' ? 'prod-cli-hal-api-app' : 'prod-hal-api-app', $GLOBALS, $_SERVER));
