<?php

namespace MyVendor\Weekday\Resource\Page;

use BEAR\Resource\ResourceObject;
use BEAR\Resource\Annotation\Embed;

class Index extends ResourceObject
{
    /**
     * @Embed(rel="weekday", src="app://self/weekday{?year,month,day}")
     */
    public function onGet($year, $month, $day)
    {
        $this['year'] = $year;
        $this['month'] = $month;
        $this['day'] = $day;

        return $this;
    }
}
