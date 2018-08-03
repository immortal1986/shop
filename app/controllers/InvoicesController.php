<?php

class InvoicesController extends ControllerBase {
    public function initialize() {
        $this->tag->setTitle('System information');
        parent::initialize();
    }

    public function indexAction() {
        $this->view->setVar('product_cnt', Products::count());
        $this->view->setVar('product_type_cnt', ProductTypes::count());
        $this->view->setVar('user_cnt', Users::count());

        $this->view->setVars(
            [
                'ip_server'  => $this->request->getServerAddress(),
                'ip_client'  => $this->request->getClientAddress(),
                'user_agent' => $this->request->getUserAgent(),
                'charset'    => $this->request->getBestCharset(),
                'language'   => $this->request->getBestLanguage()
            ]
        );
    }
}
