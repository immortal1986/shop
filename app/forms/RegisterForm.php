<?php

use Phalcon\Forms\Form, Phalcon\Forms\Element\Text, Phalcon\Forms\Element\Password,
    Phalcon\Validation\Validator\PresenceOf,Phalcon\Validation\Validator\Email;

class RegisterForm extends Form {
    public function initialize($entity = null, $options = null) {
        $name = new Text('name');
        $name->setLabel('Your Full Name');
        $name->setFilters(['striptags', 'string']);
        $name->addValidators([
            new PresenceOf([
                'message' => 'Name is required'
            ])
        ]);
        $this->add($name);

        $name = new Text('username');
        $name->setLabel('Username');
        $name->setFilters(['alpha']);
        $name->addValidators([
            new PresenceOf([
                'message' => 'Please enter your desired user name'
            ])
        ]);
        $this->add($name);

        $email = new Text('email');
        $email->setLabel('E-Mail');
        $email->setFilters('email');
        $email->addValidators([
            new PresenceOf([
                'message' => 'E-mail is required'
            ]),
            new Email([
                'message' => 'E-mail is not valid'
            ])
        ]);
        $this->add($email);

        $password = new Password('password');
        $password->setLabel('Password');
        $password->addValidators([
            new PresenceOf([
                'message' => 'Password is required'
            ])
        ]);
        $this->add($password);

        $repeatPassword = new Password('repeatPassword');
        $repeatPassword->setLabel('Repeat Password');
        $repeatPassword->addValidators([
            new PresenceOf([
                'message' => 'Confirmation password is required'
            ])
        ]);
        $this->add($repeatPassword);
    }
}
