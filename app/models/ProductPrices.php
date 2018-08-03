<?php

use Phalcon\Mvc\Model;

class ProductPrices extends Model {
    /**
     * @var integer
     */
    public $id;

    /**
     * @var integer
     */
    public $price;

    /**
     * @var string
     */
    public $date_start;

    /**
     * @var string
     */
    public $date_end;

    /**
     * @var integer
     */
    public $days_to_end;

    public function initialize() {
        $this->belongsTo('product_id', 'Products', 'id', [
            'foreignKey' => [
                'message' => 'Product Price cannot be deleted because it\'s used in Products'
            ]
        ]);
    }

    public function beforeCreate() {
        $this->days_to_end = ceil((strtotime($this->date_end) - strtotime($this->date_start)) / 86400);
    }
}
