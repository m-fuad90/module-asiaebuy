<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "oc_zone".
 *
 * @property integer $zone_id
 * @property integer $country_id
 * @property string $name
 * @property string $code
 * @property integer $status
 */
class OcZone extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oc_zone';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['country_id', 'name', 'code'], 'required'],
            [['country_id', 'status'], 'integer'],
            [['name'], 'string', 'max' => 128],
            [['code'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'zone_id' => 'Zone ID',
            'country_id' => 'Country ID',
            'name' => 'Name',
            'code' => 'Code',
            'status' => 'Status',
        ];
    }
}
