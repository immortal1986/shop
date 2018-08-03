<?php

class SessionController extends ControllerBase {
    public function initialize() {
        $this->tag->setTitle('Sign Up/Sign In');
        parent::initialize();
    }

    public function indexAction() {
        if (!$this->request->isPost()) {
            $this->tag->setDefault('email', 'demo');
            $this->tag->setDefault('password', 'phalcon');
        }
    }

    private function _registerSession(Users $user) {
        $this->session->set('auth', [
            'id'   => $user->id,
            'name' => $user->name
        ]);
    }

    public function startAction() {
        if ($this->request->isPost()) {

            $email    = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $user = Users::findFirst([
                "(email = :email: OR username = :email:) AND password = :password: AND active = 'Y'",
                'bind' => ['email' => $email, 'password' => sha1($password)]
            ]);
            if ($user != false) {
                $this->_registerSession($user);
                $this->flash->success('Welcome ' . $user->name);

                return $this->dispatcher->forward(
                    [
                        "controller" => "invoices",
                        "action"     => "index",
                    ]
                );
            }

            $this->flash->error('Wrong email/password');
        }

        return $this->dispatcher->forward(
            [
                "controller" => "session",
                "action"     => "index",
            ]
        );
    }

    public function endAction() {
        $this->session->remove('auth');
        $this->flash->success('Goodbye!');

        return $this->dispatcher->forward(
            [
                "controller" => "index",
                "action"     => "index",
            ]
        );
    }
}
