<?php

use Phalcon\Mvc\Model;

class Products extends Model {
    /**
     * @var integer
     */
    public $id;

    /**
     * @var integer
     */
    public $product_types_id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $price;

    /**
     * @var string
     */
    public $active;


    public function getSource()
    {
        return 'products';
    }


    public function initialize() {
        $this->belongsTo('product_types_id', 'ProductTypes', 'id', [
            'reusable' => true
        ]);
        $this->belongsTo('id', 'ProductPrices', 'product_id', [
            'reusable' => true
        ]);
    }

    public function getActiveDetail() {
        if ($this->active == 'Y') {
            return 'Yes';
        }
        return 'No';
    }

    public function getDefaultPrice($id) {
       return self::findFirstById($id)->toArray()['price'];
    }

    public function beforeCreate() {
        $this->active = 'Y';
    }

    public static function getListSalesPrice($id) {
       return ProductPrices::findByProductId($id);
    }


}
