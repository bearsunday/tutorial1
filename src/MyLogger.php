<?php
namespace MyVendor\Weekday;

use BEAR\AppMeta\AbstractAppMeta;

class MyLogger implements MyLoggerInterface
{
    private $logFile;

    public function __construct(AbstractAppMeta $meta)
    {
        $this->logFile = $meta->logDir . '/weekday.log';
    }

    public function log(string $message) : void
    {
        \error_log($message . \PHP_EOL, 3, $this->logFile);
    }
}
