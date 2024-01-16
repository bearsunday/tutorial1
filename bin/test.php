<?php

declare(strict_types=1);

use MyVendor\Weekday\Bootstrap;

require dirname(__DIR__) . '/autoload.php';
exit(( new Bootstrap() )('prod-cli-hal-api-app', $GLOBALS, $_SERVER));
