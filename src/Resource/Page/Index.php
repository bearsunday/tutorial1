<?php

declare(strict_types=1);

namespace MyVendor\Weekday\Resource\Page;

use BEAR\Resource\ResourceObject;
use BEAR\Resource\Annotation\Embed;

class Index extends ResourceObject
{
    #[Embed(rel:"_self", src: "app://self/weekday{?year,month,day}")]
    public function onGet(int $year, int $month, int $day): static
    {
        $this->body += [
            'year' => $year,
            'month' => $month,
            'day' => $day,
        ];

        return $this;
    }
}
