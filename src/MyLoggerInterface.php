<?php

declare(strict_types=1);

namespace MyVendor\Weekday;

interface MyLoggerInterface
{
    public function log(string $message): void;
}
