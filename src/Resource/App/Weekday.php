<?php
namespace MyVendor\Weekday\Resource\App;

use BEAR\Resource\ResourceObject;
use MyVendor\Weekday\Annotation\BenchMark;
use MyVendor\Weekday\MyLoggerInterface;

class Weekday extends ResourceObject
{
    /**
     * @var MyLoggerInterface
     */
    private $logger;

    public function __construct(MyLoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function onGet(int $year, int $month, int $day) : ResourceObject
    {
        $weekday = \DateTime::createFromFormat('Y-m-d', "$year-$month-$day")->format('D');
        $this->body = [
            'weekday' => $weekday
        ];
        $this->logger->log("$year-$month-$day {$weekday}");

        return $this;
    }
}
