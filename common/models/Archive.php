<?php

namespace common\models;

use Yii;

/**
 * This is the model class for collection "archive".
 *
 * @property \MongoDB\BSON\ObjectID|string $_id
 * @property mixed $data_archive
 */
class Archive extends \yii\mongodb\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function collectionName()
    {
        return ['asiaebuy-my', 'archive'];
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return [
            '_id',
            'data_archive',
            'date_archive',
            'date_time_archive',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['data_archive'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            '_id' => 'ID',
            'data_archive' => 'Data Archive',
        ];
    }
}
