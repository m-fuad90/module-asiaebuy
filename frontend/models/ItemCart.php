<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for collection "item_cart".
 *
 * @property \MongoDB\BSON\ObjectID|string $_id
 * @property mixed $catalog_no
 * @property mixed $quantity
 * @property mixed $date_create
 * @property mixed $date_time_create
 */
class ItemCart extends \yii\mongodb\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function collectionName()
    {
        return ['asiaebuy-my', 'item_cart'];
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return [
            '_id',
            'catalog_no',
            'quantity',
            'date_create',
            'date_time_create',
            'customer_id',
            'session_id',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['catalog_no', 'quantity', 'date_create', 'date_time_create','customer_id','session_id'], 'safe'],
           // ['catalog_no', 'required', 'message' => 'Required Field'],
            //['quantity', 'required', 'message' => 'Required Field'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            '_id' => 'ID',
            'catalog_no' => 'Catalog No',
            'quantity' => 'Quantity',
            'date_create' => 'Date Create',
            'date_time_create' => 'Date Time Create',
            'customer_id' => 'Customer',
            'session_id' => 'Session'
        ];
    }
}
