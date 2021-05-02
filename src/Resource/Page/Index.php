<?php

declare(strict_types=1);

namespace MyVendor\Weekday\Resource\Page;

use BEAR\Resource\ResourceObject;
use MyVendor\Weekday\Resource\App\Weekday;

class Index extends ResourceObject
{
    public function __construct(private Weekday $weekday)
    {
    }

    public function onGet(int $year, int $month, int $day): static
    {
        $weekday = $this->weekday->onGet($year, $month, $day);
        $this->body = [
            'year' => $year,
            'month' => $month,
            'day' => $day,
            'weekday' => $weekday->body['weekday'],
        ];

        return $this;
    }
}
