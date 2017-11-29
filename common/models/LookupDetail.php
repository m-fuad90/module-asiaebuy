<?php

namespace common\models;

use Yii;
use common\models\LookupStatus;

/**
 * This is the model class for collection "lookup-detail".
 *
 * @property \MongoDB\BSON\ObjectID|string $_id
 * @property mixed $details
 * @property mixed $date_create
 * @property mixed $date_update
 * @property mixed $enter_by
 * @property mixed $update_by
 */
class LookupDetail extends \yii\mongodb\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function collectionName()
    {
        return ['asiaebuy-my', 'lookup-detail'];
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return [
            '_id',
            'details',
            'date_create',
            'date_update',
            'enter_by',
            'update_by',
            'status'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['details', 'date_create', 'date_update', 'enter_by', 'update_by','status'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            '_id' => 'ID',
            'details' => 'Details',
            'date_create' => 'Date Create',
            'date_update' => 'Date Update',
            'enter_by' => 'Enter By',
            'update_by' => 'Update By',
            'status' => 'Status'
        ];
    }


    public function getStatus()
    {
        return $this->hasOne(LookupStatus::className(), ['_id' => 'status']);
    }





}
