<?php

namespace MyVendor\Weekday\Resource\Page;

class IndexTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \BEAR\Resource\ResourceInterface
     */
    private $resource;

    protected function setUp()
    {
        parent::setUp();
        $this->resource = clone $GLOBALS['RESOURCE'];
    }

    public function testOnGet()
    {
        $query = [
            'year' => '2000',
            'month' => '1',
            'day' => '1'
        ];
        $page = $this->resource->get->uri('page://self/index')->withQuery($query)->eager->request();
        $this->assertSame(200, $page->code);
        $this->assertSame('{"weekday":"Sat"}', (string) $page['weekday']);

        return $page;
    }
}
