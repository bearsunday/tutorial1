<?php

namespace MyVendor\Weekday\Module;

use BEAR\Package\PackageModule;
use MyVendor\Weekday\Annotation\BenchMark;
use MyVendor\Weekday\Interceptor\BenchMarker;
use Psr\Log\LoggerInterface;
use Ray\Di\AbstractModule;
use BEAR\Package\Provide\Router\AuraRouterModule;
use Ray\Di\Scope;

class AppModule extends AbstractModule
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->install(new PackageModule);
        $this->override(new AuraRouterModule);

        $this->bind(LoggerInterface::class)->toProvider(MonologLoggerProvider::class)->in(Scope::SINGLETON);

        $this->bindInterceptor(
            $this->matcher->any(),
            $this->matcher->annotatedWith(BenchMark::class),
            [BenchMarker::class]
        );
    }
}
