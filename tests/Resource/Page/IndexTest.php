<?php

declare(strict_types=1);

namespace MyVendor\Weekday\Resource\Page;

use BEAR\Resource\ResourceInterface;
use MyVendor\Weekday\Injector;
use MyVendor\Weekday\Resource\Page\Index;
use PHPUnit\Framework\TestCase;

use function assert;

class IndexTest extends TestCase
{
    private ResourceInterface $resource;

    protected function setUp(): void
    {
        $injector = Injector::getInstance('app');
        $this->resource = $injector->getInstance(ResourceInterface::class);
    }

    public function testOnGet(): void
    {
        $ro = $this->resource->get('page://self/index', [
            'year' => 2024,
            'month' => 1,
            'day' => 1,
        ]);
        assert($ro instanceof Index);
        $this->assertSame(200, $ro->code);
        $this->assertSame(2024, $ro->body['year']);
        $this->assertSame(1, $ro->body['month']);
        $this->assertSame(1, $ro->body['day']);
    }
}
