<?php

declare(strict_types=1);

namespace MyVendor\Weekday\Resource\App;

use BEAR\Resource\ResourceObject;
use DateTimeImmutable;
use MyVendor\Weekday\Annotation\BenchMark;
use MyVendor\Weekday\Exception\InvalidDateTimeException;
use MyVendor\Weekday\MyLoggerInterface;

class Weekday extends ResourceObject
{
    public function __construct(public MyLoggerInterface $logger)
    {
    }

    #[BenchMark]
    public function onGet(int $year, int $month, int $day): static
    {
        $dateTime = DateTimeImmutable::createFromFormat('Y-m-d', "$year-$month-$day");
        if (! $dateTime instanceof DateTimeImmutable) {
            throw new InvalidDateTimeException("$year-$month-$day");
        }

        $weekday = $dateTime->format('D');
        $this->body = ['weekday' => $weekday];
        $this->logger->log("$year-$month-$day {$weekday}");

        return $this;
    }
}
