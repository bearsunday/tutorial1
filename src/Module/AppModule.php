<?php

namespace MyVendor\Weekday\Module;

use BEAR\Package\PackageModule;
use Psr\Log\LoggerInterface;
use Ray\Di\AbstractModule;
use BEAR\Package\Provide\Router\AuraRouterModule;
use Ray\Di\Scope; // この行を追加

class AppModule extends AbstractModule
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->install(new PackageModule);
        $this->override(new AuraRouterModule); // この行を追加

        $this->bind(LoggerInterface::class)->toProvider(MonologLoggerProvider::class)->in(Scope::SINGLETON);
    }
}
