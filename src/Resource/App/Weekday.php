<?php

declare(strict_types=1);

namespace MyVendor\Weekday\Resource\App;

use BEAR\Resource\ResourceObject;
use DateTimeImmutable;
use MyVendor\Weekday\Exception\InvalidDateTimeException;
use MyVendor\Weekday\MyLoggerInterface;

class Weekday extends ResourceObject
{
    public function onGet(int $year, int $month, int $day): static
    {
        $dateTime = (new DateTimeImmutable())->createFromFormat('Y-m-d', "$year-$month-$day");
        if (! $dateTime instanceof DateTimeImmutable) {
            throw new InvalidDateTimeException("$year-$month-$day");
        }

        $weekday = $dateTime->format('D');
        $this->body = ['weekday' => $weekday];

        return $this;
    }
}
