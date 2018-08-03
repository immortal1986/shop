<?php

use Phalcon\Mvc\User\Component;

class Elements extends Component {
    private $_headerMenu = [
        'navbar-left'  => [
            'index'    => [
                'caption' => 'Home',
                'action'  => 'index'
            ],
            'invoices' => [
                'caption' => 'Admin',
                'action'  => 'index'
            ],
        ],
        'navbar-right' => [
            'session' => [
                'caption' => 'Log In/Sign Up',
                'action'  => 'index'
            ],
        ]
    ];

    private $_tabs = [
        'Status'        => [
            'controller' => 'invoices',
            'action'     => 'index',
            'any'        => false
        ],
        'Products'      => [
            'controller' => 'products',
            'action'     => 'index',
            'any'        => true
        ],
        'Product Types' => [
            'controller' => 'producttypes',
            'action'     => 'index',
            'any'        => true
        ],
    ];

    public function getMenu() {

        $auth = $this->session->get('auth');
        if ($auth) {
            $this->_headerMenu['navbar-right']['session'] = [
                'caption' => 'Log Out',
                'action'  => 'end'
            ];
        } else {
            unset($this->_headerMenu['navbar-left']['invoices']);
        }

        $controllerName = $this->view->getControllerName();
        foreach ($this->_headerMenu as $position => $menu) {
            echo '<div class="nav-collapse">';
            echo '<ul class="nav navbar-nav ', $position, '">';
            foreach ($menu as $controller => $option) {
                if ($controllerName == $controller) {
                    echo '<li class="active">';
                } else {
                    echo '<li>';
                }
                echo $this->tag->linkTo($controller . '/' . $option['action'], $option['caption']);
                echo '</li>';
            }
            echo '</ul>';
            echo '</div>';
        }

    }

    public function getTabs() {
        $controllerName = $this->view->getControllerName();
        $actionName     = $this->view->getActionName();
        echo '<ul class="nav nav-tabs">';
        foreach ($this->_tabs as $caption => $option) {
            if ($option['controller'] == $controllerName && ($option['action'] == $actionName || $option['any'])) {
                echo '<li class="active">';
            } else {
                echo '<li>';
            }
            echo $this->tag->linkTo($option['controller'] . '/' . $option['action'], $caption), '</li>';
        }
        echo '</ul>';
    }

    public static function getProductCard($rows) {

        foreach ($rows as $row) {
            echo ' <div class="col-sm-6 col-md-4">
				   <div class="card">
				   <h5 class="card-title text-center">Product id: <span class="text-danger">' . $row->id . '</span></h5>';
            echo '  <img class="card-img-top" src="https://image.ibb.co/eBv19R/if_users_11_984127.png" alt="Card image cap" style="width:100%">';
            echo '<div class="card-body">';
            echo '<p class="card-text card-text-name text-center">' . $row->name . '</p><hr>';
            if ($row->productPrices) {
                echo '<div class="card-text text-right">Price: <span class="text-danger price-no">' . $row->getDefaultPrice($row->id) . '</span></div>';
            } else {
                echo '<div class="card-text text-right">Price: <span class="text-danger price">' . $row->price . '</span></div>';
            }
            if ($row->productPrices) {
                echo '<div class="card-text text-right">Sale price: <span class="text-danger price">' . $row->price . '</span></div>';
            }
            echo '<hr><div class="text-right"><button class="btn btn-info buy">Buy</button></div><br></div></div></div>';
        }
    }


    /*public static function getMenu($view, $translate) {
        //$auth = Phalcon\Session::get('auth');
        $auth = false;
        if ($auth) {
            self::$_headerMenu['pull-right']['session'] = array(
                'caption' => 'Log Out',
                'action'  => 'end'
            );
        } else {
            unset(self::$_headerMenu['pull-left']['invoices']);
        }

        echo '<div class="nav-collapse">';
        $controllerName = $view->dispatcher->getControllerName();
        foreach (self::$_headerMenu as $position => $menu) {
            echo '<ul class="nav ', $position, '">';
            foreach ($menu as $controller => $option) {
                if (!isset($option['special'])) {
                    if ($controllerName == $controller) {
                        echo '<li class="active">';
                    } else {
                        echo '<li>';
                    }
                } else {
                    echo '<li class="special">';
                }
                if (isset($option['action'])) {
                    echo Phalcon\Tag::linkTo($controller . '/' . $option['action'], $translate[$option['caption']]);
                } else {
                    if (isset($option['url'])) {
                        echo '<a href="' . $option['url'] . '">' . $translate[$option['caption']] . '</a>';
                    }
                }
                echo '</li>';
            }
            echo '</ul>';
        }
        echo '</div>';
    }

    public static function getTabs($view) {
        $controllerName = $view->dispatcher->getControllerName();
        $actionName     = $view->dispatcher->getActionName();
        echo '<ul class="nav nav-tabs">';
        foreach (self::$_tabs as $caption => $option) {
            if ($option['controller'] == $controllerName && ($option['action'] == $actionName || $option['any'])) {
                echo '<li class="active">';
            } else {
                echo '<li>';
            }
            echo Phalcon\Tag::linkTo($option['controller'] . '/' . $option['action'], $caption), '<li>';
        }
        echo '</ul>';
    }

    public static function disclaimer($translate) {
        if(!Phalcon\Session::get('disclaimer')){
            echo '<div class="alert alert-info">
            <a class="close" data-dismiss="alert" href="#">×</a>
            ', $translate->_('disclaimer', array(
                'framework' => '<a href="http://phalconphp.com">Phalcon PHP Framework</a>',
                'official' => '<a href="https://www.php.net">'.$translate['accessOf'].'</a>'
            )), '
            </div>';
            Phalcon\Session::set('disclaimer', true);
        }
    }
    */
}
