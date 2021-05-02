<?php

declare(strict_types=1);

namespace MyVendor\Weekday\Module;

use BEAR\Dotenv\Dotenv;
use BEAR\Package\AbstractAppModule;
use BEAR\Package\PackageModule;
use BEAR\Package\Provide\Router\AuraRouterModule;
use MyVendor\Weekday\Annotation\BenchMark;
use MyVendor\Weekday\Interceptor\BenchMarker;
use MyVendor\Weekday\MyLogger;
use MyVendor\Weekday\MyLoggerInterface;
use Ray\AuraSqlModule\AuraSqlModule;

use function dirname;
use function sprintf;

class AppModule extends AbstractAppModule
{
    protected function configure(): void
    {
        (new Dotenv())->load(dirname(__DIR__, 2));
        $appDir = $this->appMeta->appDir;
        $this->install(new AuraRouterModule($appDir . '/var/conf/aura.route.php'));
        $this->bind(MyLoggerInterface::class)->to(MyLogger::class);
        $this->bindInterceptor(
            $this->matcher->any(),                                         // どのクラスでも
            $this->matcher->annotatedWith(BenchMark::class), // #[Attribute]と属性の付けられたメソッドに
            [BenchMarker::class]                                           // BenchMarkerインターセプターを適用
        );
        $this->install(new HtmlModule());
        $this->install(new AuraSqlModule(sprintf('sqlite:%s/var/db/todo.sq3', $this->appMeta->appDir)));
        $this->install(new PackageModule());
    }
}
