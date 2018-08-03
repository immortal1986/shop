<?php

use Phalcon\Forms\Form, Phalcon\Forms\Element\Text, Phalcon\Forms\Element\Hidden, Phalcon\Validation\Validator\PresenceOf;

class ProductTypesForm extends Form {
    public function initialize($entity = null, $options = array()) {
        if (!isset($options['edit'])) {
            $element = new Text("id");
            $this->add($element->setLabel("Id"));
        } else {
            $this->add(new Hidden("id"));
        }

        $name = new Text("name");
        $name->setLabel("Name");
        $name->setFilters(['striptags', 'string']);
        $name->addValidators([
            new PresenceOf([
                'message' => 'Name is required'
            ])
        ]);
        $this->add($name);
    }
}
