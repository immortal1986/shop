<?php

use Phalcon\Acl, Phalcon\Acl\Role, Phalcon\Acl\Resource, Phalcon\Events\Event, Phalcon\Mvc\User\Plugin, Phalcon\Mvc\Dispatcher;
use Phalcon\Acl\Adapter\Memory as AclList;

class SecurityPlugin extends Plugin {
    public function getAcl() {
        if (!isset($this->persistent->acl)) {

            $acl = new AclList();

            $acl->setDefaultAction(Acl::DENY);

            $roles = [
                'users'  => new Role(
                    'Users',
                    'Member privileges, granted after sign in.'
                ),
                'guests' => new Role(
                    'Guests',
                    'Anyone browsing the site who is not signed in is considered to be a "Guest".'
                )
            ];

            foreach ($roles as $role) {
                $acl->addRole($role);
            }

            $privateResources = [
                'products'     => ['index', 'search', 'new', 'edit', 'save', 'create', 'delete','salesadd','salesdelete'],
                'producttypes' => ['index', 'search', 'new', 'edit', 'save', 'create', 'delete'],
                'invoices'     => ['index', 'profile']
            ];
            foreach ($privateResources as $resource => $actions) {
                $acl->addResource(new Resource($resource), $actions);
            }

            $publicResources = [
                'index'    => ['index'],
                'register' => ['index'],
                'errors'   => ['show401', 'show404', 'show500'],
                'session'  => ['index', 'register', 'start', 'end'],
            ];
            foreach ($publicResources as $resource => $actions) {
                $acl->addResource(new Resource($resource), $actions);
            }

            foreach ($roles as $role) {
                foreach ($publicResources as $resource => $actions) {
                    foreach ($actions as $action) {
                        $acl->allow($role->getName(), $resource, $action);
                    }
                }
            }

            foreach ($privateResources as $resource => $actions) {
                foreach ($actions as $action) {
                    $acl->allow('Users', $resource, $action);
                }
            }

            $this->persistent->acl = $acl;
        }

        return $this->persistent->acl;
    }

    public function beforeExecuteRoute(Event $event, Dispatcher $dispatcher) {
        $auth = $this->session->get('auth');
        if (!$auth) {
            $role = 'Guests';
        } else {
            $role = 'Users';
        }

        $controller = $dispatcher->getControllerName();
        $action     = $dispatcher->getActionName();

        $acl = $this->getAcl();

        if (!$acl->isResource($controller)) {
            $dispatcher->forward([
                'controller' => 'errors',
                'action'     => 'show404'
            ]);

            return false;
        }

        $allowed = $acl->isAllowed($role, $controller, $action);
        if (!$allowed) {
            $dispatcher->forward([
                'controller' => 'errors',
                'action'     => 'show401'
            ]);
            $this->session->destroy();
            return false;
        }
    }
}
