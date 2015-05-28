<?php

namespace MyVendor\Weekday\Resource\App;

use BEAR\Resource\ResourceObject;
use BEAR\Sunday\Inject\ResourceInject;

class Import extends ResourceObject
{
    use ResourceInject;

    public function onGet()
    {
        $this['blog'] = $this->resource->get->uri('page://blog/index')->eager->request()->body['greeting'];

        return $this;
    }
}
