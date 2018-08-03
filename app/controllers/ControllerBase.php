<?php

use Phalcon\Mvc\Controller, Phalcon\Tag;

class ControllerBase extends Controller {

    protected static $pre_tittle = 'E-Shop | ';
    protected static $brand = 'E-Shop';

    protected function _getTransPath() {
        $translationPath = '../app/messages/';
        $language        = $this->session->get("language");
        if (!$language) {
            $this->session->set("language", "en");
        }
        if ($language === 'es' || $language === 'en') {
            return $translationPath . $language;
        } else {
            return $translationPath . 'en';
        }
    }


    public function loadMainTrans() {
        $translationPath = $this->_getTransPath();
        require $translationPath . "/main.php";

        //Return a translation object
        $mainTranslate = new Phalcon\Translate\Adapter\NativeArray(array(
            "content" => $messages
        ));

        //Set $mt as main translation object
        $this->view->setVar("mt", $mainTranslate);
    }

    public function loadCustomTrans($transFile) {
        $translationPath = $this->_getTransPath();
        require $translationPath . '/' . $transFile . '.php';

        //Return a translation object
        $controllerTranslate = new Phalcon\Translate\Adapter\NativeArray(array(
            "content" => $messages
        ));

        //Set $t as controller's translation object
        $this->view->setVar("t", $controllerTranslate);
    }

    protected function initialize() {
        $config = $this->set_config('colections');

        $this->tag->setDoctype(Tag::HTML401_STRICT);
        $cssCollection = $this->assets->collection("css");
        $jsCollection  = $this->assets->collection("js");
        $this->tag->prependTitle(self::$pre_tittle);
       // $this->loadMainTrans();
        $this->view->brand = self::$brand;

        $this->view->setTemplateAfter('main');

        $cssCollection->addCss($config->cssDir . 'bootstrap.min.css')
            ->addCss($config->cssDir . 'common.css')
            ->addCss('https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css', false);

        $jsCollection->addJs($config->jsDir . 'jquery.min.js')
            ->addJs('https://cdn.jsdelivr.net/momentjs/latest/moment.min.js', false)
            ->addJs('https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js', false)
            ->addJs($config->jsDir . 'bootstrap.min.js')
            ->addJs($config->jsDir . 'utils.js');
    }

    protected function set_config($sections) {
        return $this->di->get('config')->get($sections);
    }
}
