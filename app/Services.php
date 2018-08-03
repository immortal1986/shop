<?php

use Phalcon\Mvc\View, Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Mvc\Model\Metadata\Memory as MetaData;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Flash\Session as FlashSession;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Mvc\Model\Manager as ModelsManager;
use Phalcon\Mvc\View\Engine\Php as PhpEngine;
use Phalcon\Cache\Frontend\Output;
use Phalcon\Cache\Backend\File;


class Services extends \Base\Services {

    protected function initDispatcher() {
        $eventsManager = new EventsManager;
        $eventsManager->attach('dispatch:beforeExecuteRoute', new SecurityPlugin);
        $eventsManager->attach('dispatch:beforeException', new NotFoundPlugin);
        $dispatcher = new Dispatcher;
        $dispatcher->setEventsManager($eventsManager);

        return $dispatcher;
    }

    protected function initUrl() {
        $url = new UrlProvider();
        $url->setBaseUri($this->get('config')->application->baseUri);
        return $url;
    }

    protected function initView() {
        $view = new View();

        $view->setViewsDir(APP_PATH . $this->get('config')->application->viewsDir);
        $view->setPartialsDir(APP_PATH . $this->get('config')->application->partialDir);
        $view->registerEngines([
            '.volt'  => 'volt',
            '.phtml' => PhpEngine::class
        ]);

        return $view;
    }

    protected function initSharedVolt($view, $di) {
        $volt = new VoltEngine($view, $di);

        $volt->setOptions([
            "compiledPath"      => APP_PATH . "cache/volt/",
            'compileAlways'     => true,
            'compiledSeparator' => '_',
            'compiledExtension' => '.php'
        ]);

        $compiler = $volt->getCompiler();
        $compiler->addFunction('is_a', 'is_a');

        return $volt;
    }

    protected function initSharedDb() {
        $config = $this->get('config')->get('database')->toArray();

        $dbClass = 'Phalcon\Db\Adapter\Pdo\\' . $config['adapter'];
        unset($config['adapter']);

        return new $dbClass($config);
    }

    protected function initModelsMetadata() {
        return new MetaData();
    }

    protected function initSession() {
        $session = new SessionAdapter();
        $session->start();
        return $session;
    }

    protected function initFlash() {
        return new FlashSession([
            'error'   => 'alert alert-danger',
            'success' => 'alert alert-success',
            'notice'  => 'alert alert-info',
            'warning' => 'alert alert-warning'
        ]);
    }

    protected function initModelsManager() {
        return new ModelsManager();
    }

    protected function initElements() {
        return new Elements();
    }

    /*protected function initviewCache() {
        $frontCache = new Output([
            "lifetime" => 2592000
        ]);

        $cache = new File($frontCache,[
            "cacheDir" => APP_PATH . "cache/volt/",
            "prefix"   => "php"
        ]);

        return $cache;
    }*/

}
