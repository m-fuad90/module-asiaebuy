<?php

namespace common\models;

use Yii;

/**
 * This is the model class for collection "project".
 *
 * @property \MongoDB\BSON\ObjectID|string $_id
 * @property mixed $email
 * @property mixed $name
 * @property mixed $address
 * @property mixed $postcode
 * @property mixed $city
 * @property mixed $province
 * @property mixed $contact_no
 * @property mixed $company_name
 * @property mixed $diff_name
 * @property mixed $diff_address
 * @property mixed $diff_postcode
 * @property mixed $diff_city
 * @property mixed $diff_province
 * @property mixed $diff_contact_no
 * @property mixed $diff_country
 */
class Project extends \yii\mongodb\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function collectionName()
    {
        return ['asiaebuy-my', 'project'];
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return [
            '_id',
            'email',
            'name',
            'address',
            'postcode',
            'city',
            'province',
            'country',
            'contact_no',
            'company_name',
            'myRFQ',
            'data',
            'date_create',
            'date_time_create',
            'belong_to',
            'currency',
            'status',
            'diff_add_info',
            'diff_company',
            'diff_name',
            'diff_address',
            'diff_postcode',
            'diff_city',
            'diff_province',
            'diff_country',
            'quotation_no',
            'date_quotation',
            'date_time_quotation',
            'in_percentage_dis',
            'tax',
            'validity',
            'lead_time',
            'remark_all',
            'in_percentage_dis',
            'discount',
            'type_tax',
            'total',
            'reason_revise',
            'revise',
            'reviseCount',
            'paymentID',
            'payerID',
            'paymentToken',
            'invoice_no',
            'date_invoice',
            'date_time_invoice',
            'payment_type',
            'date_time_payment',
            'date_payment',
            'transactionID',

        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            /*[['email', 'name', 'address', 'postcode', 'city', 'province', 'contact_no', 'company_name', 'diff_name', 'diff_address', 'diff_postcode', 'diff_city', 'diff_province', 'diff_contact_no', 'diff_country','diff_add_info','status','data','date_create','date_time_create','belong_to','myRFQ','quotation_no','date_quotation','date_time_quotation','type_tax','tax','discount','freight','freight_per_item','remark','currency','date','date_time','validity','lead_time','remark_all','total','revise','reason_revise','reviseCount','discount_per_item','discount_per_item_value','in_percentage','per_item','in_percentage_dis','choosed','paypal_status','paymentId','PayerID'], 'safe'], */

            /*['email', 'required', 'message' => 'Please enter your email address'],
            //['company_name', 'required', 'message' => 'Required Field'],
            ['name', 'required', 'message' => 'Required Field'],
            ['address', 'required', 'message' => 'Required Field'],
            ['postcode', 'required', 'message' => 'Required Field'],
            ['city', 'required', 'message' => 'Required Field'],
            ['contact_no', 'required', 'message' => 'Required Field'],*/
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            '_id' => 'ID',
            'email' => 'Email',
            'name' => 'Name',
            'address' => 'Address',
            'postcode' => 'Postcode',
            'city' => 'City',
            'country' => 'Country',
            'contact_no' => 'Contact No',
            'company_name' => 'Company Name',
            'diff_company' => 'Diff Company',
            'diff_name' => 'Diff Name',
            'diff_address' => 'Diff Address',
            'diff_postcode' => 'Diff Postcode',
            'diff_city' => 'Diff City',
            'diff_province' => 'Diff Province',
            'diff_contact_no' => 'Diff Contact No',
            'diff_country' => 'Diff Country',
            'status' => 'Status',
            'data' => 'data',
            'myRFQ' => 'myRFQ',
            'invoice_no' => 'Invoice No',

        ];
    }


    public static function reviseAdmin()
    {

        $data = Project::find()
        ->where(['revise'=>'Yes'])
        ->orderBy([
           '_id'=>SORT_DESC,
        ])
        ->all();
        
        return $data;

    }




}
