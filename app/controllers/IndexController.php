<?php

class IndexController extends ControllerBase {
    public function initialize() {
        $this->tag->setTitle('Welcome');
        //   $this->loadCustomTrans('index');
        parent::initialize();
    }

    public function indexAction() {
        if (!$this->request->isPost()) {
            $this->flash->notice('Welcome to our E-shop');
        }

        $products         = Products::find()->filter(function ($p) {
            $all_prices_for_product = ProductPrices::find('product_id=' . $p->id);
            $days_to_end            = ProductPrices::minimum(['column' => 'days_to_end', 'conditions' => 'product_id=' . $p->id]);
            $sales_prices           = $all_prices_for_product->toArray();
            if (count($sales_prices) > 0) {
                foreach ($sales_prices as $price) {
                    if ($price['days_to_end'] == $days_to_end) {
                        // echo $p->price;
                        $p->price = $price['price'];
                    }
                }

            } else {
                //  $p->price = $p->price ;
            }
            return $p;
        });
        if(count($products)==0){
            $this->flash->error('NO PRODUCTIONS TO SHOW');
        }
        $this->view->rows = $products;
    }

    public function setLanguageAction($language = '') {
        //Change the language, reload translations if needed
        if ($language == 'en' || $language == 'es') {
            $this->session->set('language', $language);
            $this->loadMainTrans();
            $this->loadCustomTrans('index');
        }

        //Go to the last place
        $referer = $this->request->getHTTPReferer();
        if (strpos($referer, $this->request->getHttpHost() . "/") !== false) {
            return $this->response->setHeader("Location", $referer);
        } else {
            return $this->dispatcher->forward(array('controller' => 'index', 'action' => 'index'));
        }
    }
}
