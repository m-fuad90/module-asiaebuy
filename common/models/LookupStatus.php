<?php

namespace common\models;

use Yii;

/**
 * This is the model class for collection "lookup-status".
 *
 * @property \MongoDB\BSON\ObjectID|string $_id
 * @property mixed $status
 * @property mixed $date_create
 * @property mixed $date_update
 * @property mixed $enter_by
 * @property mixed $update_by
 */
class LookupStatus extends \yii\mongodb\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function collectionName()
    {
        return ['asiaebuy-my', 'lookup-status'];
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return [
            '_id',
            'status',
            'date_create',
            'date_update',
            'enter_by',
            'update_by',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'date_create', 'date_update', 'enter_by', 'update_by'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            '_id' => 'ID',
            'status' => 'Status',
            'date_create' => 'Date Create',
            'date_update' => 'Date Update',
            'enter_by' => 'Enter By',
            'update_by' => 'Update By',
        ];
    }
}
