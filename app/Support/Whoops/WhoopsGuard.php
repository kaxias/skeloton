<?php

namespace App\Support\Whoops;

use Psr\Http\Message\ServerRequestInterface as Request;
use SimpleSlim\App;
use Whoops\Handler\JsonResponseHandler;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;
use Whoops\Util\Misc;

class WhoopsGuard
{
    protected array $settings = [];
    protected Request|null $request = null;
    protected array $handlers = [];

    public function __construct(array $settings = [])
    {
        $this->settings = array_merge(['enable' => true, 'editor' => '', 'title' => ''], $settings);
    }

    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }

    public function setHandlers(array $handlers): void
    {
        $this->handlers = $handlers;
    }

    public function install(): ?Run
    {
        if ($this->settings['enable'] === false) return null;

        $prettyPageHandler = new PrettyPageHandler();

        if (empty($this->settings['editor']) === false) $prettyPageHandler->setEditor($this->settings['editor']);

        if (empty($this->settings['title']) === false) $prettyPageHandler->setPageTitle($this->settings['title']);

        $contentCharset = '<none>';
        if (method_exists($this->request, 'getContentCharset') === true && $this->request->getContentCharset() !== null) {
            $contentCharset = $this->request->getContentCharset();
        }

        $prettyPageHandler->addDataTable('Slim Application', [
            'Version' => App::VERSION,
            'Accept Charset' => $this->request->getHeader('ACCEPT_CHARSET') ?: '<none>',
            'Content Charset' => $contentCharset,
            'HTTP Method' => $this->request->getMethod(),
            'Path' => $this->request->getUri()->getPath(),
            'Query String' => $this->request->getUri()->getQuery() ?: '<none>',
            'Base URL' => (string)$this->request->getUri(),
            'Scheme' => $this->request->getUri()->getScheme(),
            'Port' => $this->request->getUri()->getPort(),
            'Host' => $this->request->getUri()->getHost(),
        ]);

        $whoops = new Run;
        $whoops->pushHandler($prettyPageHandler);

        if (Misc::isAjaxRequest() === true) $whoops->pushHandler(new JsonResponseHandler());

        if (empty($this->handlers) === false) foreach ($this->handlers as $handler) $whoops->pushHandler($handler);

        $whoops->register();

        return $whoops;
    }
}
