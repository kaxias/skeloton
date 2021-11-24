<?php

namespace App\Support\Twig\Extension;

use App\Support\Facades\Config;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use Psr\Container\ContainerInterface;
use RuntimeException;

class MixRuntime
{
    protected ContainerInterface $container;
    protected string $public_folder;

    /** @noinspection PhpUnhandledExceptionInspection */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->public_folder = $this->container->get('path.public');
    }

    public function asset(string $path): HtmlString
    {
        if (!Str::startsWith($path, '/')) $path = "/$path";

        return new HtmlString(Config::get('app.url') . $path);
    }

    public function mix(string $path, string $manifestDirectory = ''): HtmlString
    {
        static $manifests = [];

        if (!Str::startsWith($path, '/')) $path = "/$path";

        if ($manifestDirectory && !Str::startsWith($manifestDirectory, '/')) $manifestDirectory = "/$manifestDirectory";

        $manifestPath = $this->public_folder . $manifestDirectory . DIRECTORY_SEPARATOR . 'mix-manifest.json';

        if (!isset($manifests[$manifestPath])) {
            if (!file_exists($manifestPath)) throw new RuntimeException('The Mix manifest does not exist.');

            $manifests[$manifestPath] = json_decode(file_get_contents($manifestPath), true);
        }

        $manifest = $manifests[$manifestPath];

        if (!isset($manifest[$path])) throw new RuntimeException("Unable to locate Mix file: $path.");

        return new HtmlString(Config::get('app.url') . $manifestDirectory . $manifest[$path]);
    }
}
