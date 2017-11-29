<?php

namespace common\models;

use Yii;

/**
 * This is the model class for collection "status".
 *
 * @property \MongoDB\BSON\ObjectID|string $_id
 * @property mixed $items
 * @property mixed $detailsproject
 */
class Status extends \yii\mongodb\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function collectionName()
    {
        return ['asiaebuy-my', 'status'];
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return [
            '_id',
            'item',
            'detail',
            'project',
            'in_time_status'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item', 'detail','project','in_time_status'], 'safe'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            '_id' => 'ID',
            'item' => 'Item',
            'details' => 'Details',
            'project' => 'projects',
            'in_time_status' => 'in_time_status'
        ];
    }
}
