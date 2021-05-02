<?php

declare(strict_types=1);

namespace MyVendor\Weekday\Http;

use BEAR\Dev\Http\BuiltinServerStartTrait;
use BEAR\Resource\ResourceObject;
use MyVendor\Weekday\Hypermedia\WorkflowTest as Workflow;
use MyVendor\Weekday\Injector;

class WorkflowTest extends Workflow
{
    use BuiltinServerStartTrait;

    protected function setUp(): void
    {
        $_SERVER['Authorization'] = '_secret_token_';
        $this->resource = $this->getHttpResourceClient(Injector::getInstance('app'), self::class);
    }

    public function testIndex(): ResourceObject
    {
        $ro = $this->resource->get('page://self/index', ['year' => '2001', 'month' => '1', 'day' => '1']);
        $this->assertSame(200, $ro->code);

        return $ro;
    }
}
