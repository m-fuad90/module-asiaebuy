<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "oc_customer".
 *
 * @property integer $customer_id
 * @property integer $customer_group_id
 * @property integer $store_id
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property string $telephone
 * @property string $fax
 * @property string $encode64_password
 * @property string $password
 * @property string $salt
 * @property string $cart
 * @property string $wishlist
 * @property integer $newsletter
 * @property integer $address_id
 * @property string $custom_field
 * @property string $ip
 * @property integer $status
 * @property integer $approved
 * @property integer $safe
 * @property string $token
 * @property string $code
 * @property string $date_added
 */
class OcCustomer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oc_customer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_group_id', 'firstname', 'lastname', 'email', 'telephone', 'fax', 'password', 'salt', 'custom_field', 'ip', 'status', 'approved', 'safe', 'token', 'code', 'date_added'], 'required'],
            [['customer_group_id', 'store_id', 'newsletter', 'address_id', 'status', 'approved', 'safe'], 'integer'],
            [['cart', 'wishlist', 'custom_field', 'token'], 'string'],
            [['date_added'], 'safe'],
            [['firstname', 'lastname', 'telephone', 'fax'], 'string', 'max' => 32],
            [['email'], 'string', 'max' => 96],
            [['encode64_password'], 'string', 'max' => 255],
            [['password', 'ip', 'code'], 'string', 'max' => 40],
            [['salt'], 'string', 'max' => 9],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'customer_id' => 'Customer ID',
            'customer_group_id' => 'Customer Group ID',
            'store_id' => 'Store ID',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'email' => 'Email',
            'telephone' => 'Telephone',
            'fax' => 'Fax',
            'encode64_password' => 'Encode64 Password',
            'password' => 'Password',
            'salt' => 'Salt',
            'cart' => 'Cart',
            'wishlist' => 'Wishlist',
            'newsletter' => 'Newsletter',
            'address_id' => 'Address ID',
            'custom_field' => 'Custom Field',
            'ip' => 'Ip',
            'status' => 'Status',
            'approved' => 'Approved',
            'safe' => 'Safe',
            'token' => 'Token',
            'code' => 'Code',
            'date_added' => 'Date Added',
        ];
    }





}
