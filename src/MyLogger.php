<?php

declare(strict_types=1);

namespace MyVendor\Weekday;

use BEAR\AppMeta\AbstractAppMeta;

use function error_log;

use const PHP_EOL;

class MyLogger implements MyLoggerInterface
{
    private string $logFile;

    public function __construct(AbstractAppMeta $meta)
    {
        $this->logFile = $meta->logDir . '/weekday.log';
    }

    public function log(string $message): void
    {
        error_log($message . PHP_EOL, 3, $this->logFile);
    }
}
