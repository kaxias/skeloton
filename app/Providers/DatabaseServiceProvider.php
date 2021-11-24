<?php

namespace App\Providers;

use App\Support\Facades\Config;
use Illuminate\Database\Capsule\Manager;
use SimpleSlim\App;

class DatabaseServiceProvider extends ServiceProvider
{
    /** @noinspection PhpArrayShapeAttributeCanBeAddedInspection */
    public function register(): array
    {
        return [
            Manager::class => function () {
                $manager = new Manager();
                $manager->addConnection(Config::get('database.connections.' . env('DB_CONNECTION')));
                $manager->setAsGlobal();
                $manager->bootEloquent();

                return $manager;
            },
        ];
    }

    /** @noinspection PhpPossiblePolymorphicInvocationInspection */
    public function boot(App $app): void
    {
        $app->getContainer()->make(Manager::class);
    }
}
