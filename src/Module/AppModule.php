<?php

namespace MyVendor\Weekday\Module;

use BEAR\Package\PackageModule;
use BEAR\Resource\ImportApp;
use BEAR\Resource\Module\ImportAppModule;
use MyVendor\Weekday\Annotation\BenchMark;
use MyVendor\Weekday\Interceptor\BenchMarker;
use Psr\Log\LoggerInterface;
use Ray\AuraSqlModule\AuraSqlModule;
use Ray\CakeDbModule\CakeDbModule;
use Ray\Di\AbstractModule;
use BEAR\Package\Provide\Router\AuraRouterModule;
use Ray\Di\Scope;
use BEAR\Package\Context;

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

        $dbConfig = [
            'driver' => 'Cake\Database\Driver\Sqlite',
            'database' => dirname(dirname(__DIR__)) . '/var/db/todo.sqlite3'
        ];
        $this->install(new CakeDbModule($dbConfig));

        $dbConfig = 'sqlite:' . dirname(dirname(__DIR__)). '/var/db/post.sqlite3';
        $this->install(new AuraSqlModule($dbConfig));

        $importConfig = [
            new ImportApp('blog', 'Acme\Blog', 'prod-hal-app') // host, name, context
        ];
        $this->override(new ImportAppModule($importConfig , Context::class));
    }
}
