<?php

declare(strict_types=1);

namespace MyVendor\Weekday\Hypermedia;

use BEAR\Resource\ResourceInterface;
use BEAR\Resource\ResourceObject;
use MyVendor\Weekday\Injector;
use PHPUnit\Framework\TestCase;
use Ray\Di\InjectorInterface;

class WorkflowTest extends TestCase
{
    protected ResourceInterface $resource;
    protected InjectorInterface $injector;

    protected function setUp(): void
    {
        $this->injector = Injector::getInstance('app');
        $this->resource = $this->injector->getInstance(ResourceInterface::class);
    }

    public function testIndex(): ResourceObject
    {
        $ro = $this->resource->get('page://self/index', ['year' => '2001', 'month' => '1', 'day' => '1']);
        $this->assertSame(200, $ro->code);

        return $ro;
    }

//    /**
//     * @depends testIndex
//     */
//    public function testRelFoo(ResourceObject $response): ResourceObject
//    {
//        $json = (string) $response;
//        $href = json_decode($json)->_links->{'name:foo'}->href;
//        $ro = $this->resource->get($href);
//        $this->assertSame(200, $ro->code);
//
//        return $ro;
//    }
}
