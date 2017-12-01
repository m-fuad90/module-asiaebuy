<?php

namespace common\models;

use Yii;

/**
 * This is the model class for collection "email".
 *
 * @property \MongoDB\BSON\ObjectID|string $_id
 * @property mixed $from
 * @property mixed $to
 * @property mixed $subject
 * @property mixed $text
 * @property mixed $date_mail
 * @property mixed $date_time_mail
 */
class Email extends \yii\mongodb\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function collectionName()
    {
        return ['asiaebuy-my', 'email'];
    }

    /**
     * {@inheritdoc}
     */
    public function attributes()
    {
        return [
            '_id',
            'from_who',
            'to_who',
            'subject',
            'text',
            'date_mail',
            'date_time_mail',
            'project_id',
            'myRFQ',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['from_who', 'to_who', 'subject', 'text', 'date_mail', 'date_time_mail','project_id','myRFQ'], 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            '_id' => 'ID',
            'from_who' => 'From',
            'to_who' => 'To',
            'subject' => 'Subject',
            'text' => 'Text',
            'date_mail' => 'Date Mail',
            'date_time_mail' => 'Date Time Mail',
        ];
    }
}
