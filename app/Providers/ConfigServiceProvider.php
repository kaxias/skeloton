<?php

namespace App\Providers;

use Illuminate\Contracts\Config\Repository;
use Illuminate\Config\Repository as Config;
use Psr\Container\ContainerInterface as Container;
use SimpleSlim\App;
use Symfony\Component\Finder\Finder;

class ConfigServiceProvider extends ServiceProvider
{
    /** @noinspection PhpArrayShapeAttributeCanBeAddedInspection */
    public function register(): array
    {
        return [
            Repository::class => fn(Container $container) => new Config($container->get('configuration')),
        ];
    }

    /**
     * @noinspection PhpPossiblePolymorphicInvocationInspection
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function boot(App $app): void
    {
        $app->getContainer()->set('configuration', function (Container $container) {
            $files = [];
            $configuration = [];

            foreach (Finder::create()->files()->name('*.php')->in($container->get('path.config')) as $file) {
                $files[basename($file->getRealPath(), '.php')] = $file->getRealPath();
            }

            foreach ($files as $key => $file) $configuration[$key] = require $file;

            return $configuration;
        });
    }
}
