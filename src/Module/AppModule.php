<?php
namespace MyVendor\Weekday\Module;

use BEAR\Package\AbstractAppModule;
use BEAR\Package\PackageModule;
use BEAR\Package\Provide\Router\AuraRouterModule;
use MyVendor\Weekday\Annotation\BenchMark;
use MyVendor\Weekday\Interceptor\BenchMarker;
use MyVendor\Weekday\MyLogger;
use MyVendor\Weekday\MyLoggerInterface;
use Ray\CakeDbModule\CakeDbModule;

class AppModule extends AbstractAppModule
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $appDir = $this->appMeta->appDir;
        require_once $appDir . '/env.php';
        $this->install(new AuraRouterModule($appDir . '/var/conf/aura.route.php'));
        $this->bind(MyLoggerInterface::class)->to(MyLogger::class);
        $this->bindInterceptor(
            $this->matcher->any(),
            $this->matcher->annotatedWith(BenchMark::class),
            [BenchMarker::class]
        );
        $dbConfig = [
            'driver' => 'Cake\Database\Driver\Sqlite',
            'database' => $appDir . '/var/db/todo.sqlite3'
        ];
        $this->install(new CakeDbModule($dbConfig));
        $this->install(new PackageModule);
    }
}
