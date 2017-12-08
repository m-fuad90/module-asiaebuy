<?php

namespace frontend\modules\fisher\controllers;

use Yii;
use common\models\Project;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
//use common\components\paypal;
use common\models\Status;
use common\models\Notification;
use common\models\User;
use common\models\Asiaebuy;
use common\models\Paypal;
use common\models\Email;
use yii\helpers\Url;
use yii\db\Query;
/**
 * ProjectController implements the CRUD actions for Project model.
 */
class ProjectController extends Controller
{

    public $layout = '@frontend/views/layouts/module.php';

    public function actionRfq()
    {
   
        $models = Project::find()->where(
            [
                'status' => 'Submit',
                'belong_to' => Yii::$app->user->identity->id
            ])->all();

        return $this->render('rfq', [
            'models' => $models,
        ]);
    }

    public function actionView($id)
    {
        //$this->layout = 'html';
        $this->layout = '@frontend/views/layouts/html.php';
        $asiaebuy = Asiaebuy::find()->one();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'asiaebuy' => $asiaebuy,
        ]);
    }

    public function actionInvoice($id)
    {
        //$this->layout = 'html';
        $this->layout = '@frontend/views/layouts/html.php';
        $asiaebuy = Asiaebuy::find()->one();
        return $this->render('invoice', [
            'model' => $this->findModel($id),
            'asiaebuy' => $asiaebuy,
        ]);
    }




    protected function findModel($id)
    {
        if (($model = Project::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionQuotation()
    {

        $models = Project::find()
        ->andWhere(['belong_to'=> Yii::$app->user->identity->id])
        ->andWhere(['or',
           ['status'=> 'Quoted'],
           ['status'=> 'Order Placed']
        ])->all();




        return $this->render('quotation', [
            'models' => $models,
        ]);
    }

    public function actionOrder()
    {


        $collection = Yii::$app->mongodb->getCollection('project');
        $models = $collection->aggregate([
            [
                '$unwind' => '$data'
            ], 
            [
                '$match' => [

                    '$and' => [
                            [
                                'status' => 'Completed'
                            ],
                            [
                                'belong_to' => Yii::$app->user->identity->id,
                            ],
                            [
                                'data.choosed' => 'on'
                            ]
                 


                    ],

                    
                ]
            ],
            [
                '$group' => [
                    '_id' => '$_id',
                    'currency' => ['$first' => '$currency' ],
                    'discount' => ['$first' => '$discount' ],
                    'tax' => ['$first' => '$tax' ],
                    'type_tax' => ['$first' => '$type_tax' ],
                    'in_percentage_dis' => ['$first' => '$in_percentage_dis' ],
                    'myRFQ' => ['$first' => '$myRFQ' ],
                    'date_create' => ['$first' => '$date_create' ],
                    'diff_add_info' => ['$first' => '$diff_add_info' ],
                    'diff_name' => ['$first' => '$diff_name' ],
                    'diff_address' => ['$first' => '$diff_address' ],
                    'diff_postcode' => ['$first' => '$diff_postcode' ],
                    'diff_city' => ['$first' => '$diff_city' ],
                    'diff_province' => ['$first' => '$diff_province' ],
                    'diff_country' => ['$first' => '$diff_country' ],
                    'diff_contact_no' => ['$first' => '$diff_contact_no' ],
                    'reason_revise'=> ['$first' => '$reason_revise' ],
                    'revise'=> ['$first' => '$revise' ],
                    'quotation_no' => ['$first' => '$quotation_no' ],
                    'reviseCount'=> ['$first' => '$reviseCount' ],
                    'name' => ['$first' => '$name' ],
                    'company_name' => ['$first' => '$company_name' ],
                    'address' => ['$first' => '$address' ],
                    'postcode' => ['$first' => '$postcode' ],
                    'city' => ['$first' => '$city' ],
                    'province' => ['$first' => '$province' ],
                    'contact_no' => ['$first' => '$contact_no' ],
                    'email' => ['$first' => '$email' ],
                    'invoice_no' => ['$first' => '$invoice_no' ],

                    'data' => [
                        '$push' => [
                            'catalog_no' => '$data.catalog_no',
                            'item' => '$data.item',
                            'specification' => '$data.specification',
                            'description' => '$data.description',
                            'remark' => '$data.remark',
                            'price' => '$data.price',
                            'quantity'  => '$data.quantity',
                            'freight'  => '$data.freight',
                            'freight_per_item'  => '$data.freight_per_item',
                            'discount_per_item'  => '$data.discount_per_item',
                            'in_percentage' => '$data.in_percentage',
                            'discount_per_item_value' => '$data.discount_per_item_value',
                            'per_item' => '$data.per_item',
                            

                            
                        ],
                        
                    ],


            
                ]
            ],


        ]);




        return $this->render('order', [
            'models' => $models,
        ]);
    }

    public function actionReview($id)
    {
        $asiaebuy = Asiaebuy::find()->one();
        $model = $this->findModel($id);
        $collection = Yii::$app->mongodb->getCollection('project');


        $newProject_id = new \MongoDB\BSON\ObjectID($id);

        $nty = Notification::find()
        ->where([
            'project' => $newProject_id,
            'status' => '',
        ])
        ->one();

        if ($nty->read_unread == 0) {

        } else {
            $nty->read_unread = 0;
            $nty->status = 'Need To Confirm';

            $nty->save();
        }




        if ($model->load(Yii::$app->request->post()) ) {

            $i=0; foreach ($_POST['Project'] as $key => $value) { $i++;

       
               $arrUpdate = [
                    '$set' => [
                
                        'data.'.$key.'.choosed' => empty($value['choosed']) ? '': $value['choosed'], 
                        'data.'.$key.'.date_choosed' => date('Y-m-d'),
                        'data.'.$key.'.date_time_choosed' => date('Y-m-d H:i:s'), 
                        'data.'.$key.'.paypal_name' => $value['name'], 
                        'data.'.$key.'.paypal_price' => round($value['price'] / $value['quantity'],2), 
                        'data.'.$key.'.paypal_currency' => $value['currency'], 
                        'status' => 'Order Placed',


                    ],
    
                
                ];

                $collection->update(['_id' => (string)$id],$arrUpdate);
      
               
            } 

            return $this->redirect(['place', 'id' => (string)$model->_id]);


        } else {
            return $this->render('review', [
                'model' => $model,
                'asiaebuy' => $asiaebuy,
            ]);
        }


    }

    public function actionPlace($id)
    {   
        $user = User::find()->where(['_id' => Yii::$app->user->identity->id])->one();

        $customer_id = base64_decode($user->customer_id);

        $query2 = new Query;
        $query2  ->select(['oc_country.name AS country_name','oc_zone.name AS zone_name','oc_address.*'])  
                ->from('oc_customer')
                ->leftJoin('oc_address','oc_customer.address_id = oc_address.address_id')
                ->leftJoin('oc_country','oc_address.country_id = oc_country.country_id')
                ->leftJoin('oc_zone','oc_address.zone_id = oc_zone.zone_id')
                ->where(
                    [
                        'oc_customer.customer_id'=>$customer_id,

                    ])
                ->one(); 

                
        $command2 = $query2->createCommand();
        $address_check = $command2->queryAll();


        $newProject_id = new \MongoDB\BSON\ObjectID($id);

        $collection = Yii::$app->mongodb->getCollection('project');
        $model = $collection->aggregate([
            [
                '$unwind' => '$data'
            ], 
            [
                '$match' => [

                    '$and' => [
                            [
                                'data.choosed' => 'on'
                            ],
                            [
                                '_id' => $newProject_id,

                            ]
                 


                    ],

                    
                ]
            ],
            [
                '$group' => [
                    '_id' => '$_id',
                    'name'  => ['$first' => '$name' ],
                    'email'  => ['$first' => '$email' ],
                    'company_name'  => ['$first' => '$company_name' ],
                    'address'  => ['$first' => '$address' ],
                    'postcode'  => ['$first' => '$postcode' ],
                    'city'  => ['$first' => '$city' ],
                    'province'  => ['$first' => '$province' ],
                    'country'  => ['$first' => '$country' ],
                    'contact_no'  => ['$first' => '$contact_no' ],
                    'currency' => ['$first' => '$currency' ],
                    'myRFQ'  => ['$first' => '$myRFQ' ],
                    'discount' => ['$first' => '$discount' ],
                    'tax' => ['$first' => '$tax' ],
                    'type_tax' => ['$first' => '$type_tax' ],
                    'in_percentage_dis' => ['$first' => '$in_percentage_dis' ],
                    'payment_type' => ['$first' => '$payment_type' ],
                    'date_payment' => ['$first' => '$date_payment' ],
                    'date_time_payment' => ['$first' => '$date_time_payment' ],
                    'total'=> ['$first' => '$total' ],
                    'diff_add_info'  => ['$first' => '$diff_add_info' ],
                    'diff_company' => ['$first' => '$diff_company' ],
                    'diff_name'  => ['$first' => '$diff_name' ],
                    'diff_address' => ['$first' => '$diff_address' ],
                    'diff_postcode' => ['$first' => '$diff_postcode' ],
                    'diff_city' => ['$first' => '$diff_city' ],
                    'diff_province' => ['$first' => '$diff_province' ],
                    'diff_country' => ['$first' => '$diff_country' ],
                    'lead_time' => ['$first' => '$lead_time' ],
                    'validity' => ['$first' => '$validity' ],



                    
                    'data' => [
                        '$push' => [
                            'catalog_no' => '$data.catalog_no',
                            'quantity' => '$data.quantity',
                            'description' => '$data.description',
                            'price' => '$data.price',
                            'specification' => '$data.specification',
                            'item' => '$data.item',
                            'freight' => '$data.freight',
                            'freight_per_item' => '$data.freight_per_item',
                            'discount_per_item'  => '$data.discount_per_item',
                            'discount_per_item_value' => '$data.discount_per_item_value',
                            'in_percentage'  => '$data.in_percentage',
                            'remark'  => '$data.remark',
                            'per_item'  => '$data.per_item',
                            //'in_percentage' => '$data.in_percentage',
                            //'discount_per_item_value' => '$data.discount_per_item_value',
                            //'per_item' => '$data.per_item',
                            

                            
                        ],
                        
                    ],
                    'show' => [
                        '$push' => [
                            'name' => '$data.paypal_name',
                            'price' => '$data.paypal_price',
                            'currency' => '$data.paypal_currency',
                            'description' => '$data.description',
                            'quantity'  => '$data.quantity',

                            

                            
                        ],
                        
                    ],


            
                ]
            ],


        ]);





        foreach ($model as $key => $value) {
            $data = $value['data'];
            $show = $value['show'];
         }




        return $this->render('place', [
            'model' => $model,
            'data' => $data,
            'show' => $show,
            'newProject_id' => $newProject_id,
            'country_user' => $address_check[0]['country_id'],

        ]);
    }

    public function actionUndo($id)
    {
        $model = $this->findModel($id);

        $collection = Yii::$app->mongodb->getCollection('project');

        foreach ($model->data as $key => $value) {

            $arrUpdate = [
                '$set' => [
                    'data.'.$key.'.choosed' => '', 
                    'data.'.$key.'.date_choosed' => '',
                    'data.'.$key.'.date_time_choosed' => '', 
                    'status' => 'Quoted',
                    'data.'.$key.'.paypal_name' => '', 
                    'data.'.$key.'.paypal_price' => '', 
                    'data.'.$key.'.paypal_currency' => '', 




                ],
                '$unset' => [
                    'paypal'=> 1
                ]

  
            ];
            $collection->update(['_id' => (string)$id],$arrUpdate);

        
        }

        return $this->redirect(['review', 'id' => (string)$model->_id]);



    }

    public function actionPaypal($value,$currency,$project)
    {

        $p = new paypal();
        $response = $p->payit($value,$currency,$project,[]);

        $url = $response->links[1]->href;


        header('Location: '.$url);
        die();


    }

    public function actionTransaction($paymentID,$payerID,$paymentToken,$project,$transacId,$total_final,$handling_fee)
    {

        $status = new Status();
        $paypal = new Paypal();
        $model = $this->findModel($project);

        $user = User::find()->where(['_id' => Yii::$app->user->identity->id])->one();

            $check = Project::find()
            ->orderBy([
               'invoice_no'=>SORT_DESC,
            ])
            ->limit(1)
            ->all();

            foreach ($check as $key => $value) {
                $temp = $value['invoice_no'];
            }

            $runningNo = $temp;

            $no = 1000;

            if (empty($runningNo)) {

                $invoice_no = $no;
                $date_invoice = date('Y-m-d');
                $date_time_invoice = date('Y-m-d H:i:s');

            } else {

                if (empty($model->invoice_no)) {

                    $invoice_no = $runningNo + 1;
                    $date_invoice = date('Y-m-d');
                    $date_time_invoice = date('Y-m-d H:i:s');


                } elseif (!empty($model->invoice_no)) {

                }


            }

            $model->total = $total_final;
            $model->handling_fee = $handling_fee;
            $model->invoice_no = $invoice_no;
            $model->date_invoice = $date_invoice;
            $model->date_payment = date('Y-m-d');
            $model->date_time_payment = date('Y-m-d H:i:s');
            $model->date_time_invoice = $date_time_invoice;
            $model->payment_type = 'Credit Card';
            $model->status = 'Completed';
            $model->paymentID = $paymentID;
            $model->payerID = $payerID;
            $model->paymentToken = $paymentToken;
            $model->transactionID = $transacId;
            $status->in_time_status = 'Processing';
            $status->item = [[
                'status' => 'Processing',
                'date' => date('Y-m-d'),
                'date_time' => date('Y-m-d H:i:s'),
            ]];
            $status->detail = [[
                'status' => 'Thank you for shopping with Asiaebuy! Your order has been received and is going through verification process. Next update will be sent to you via email soon.',
                'date' => date('Y-m-d'),
                'date_time' => date('Y-m-d H:i:s'),
            ]];
            $status->project = (string)$project;

            $newProject_id = new \MongoDB\BSON\ObjectID($project);

            $nty = Notification::find()
            ->where([
                'project' => $newProject_id,
                'status' => 'Need To Confirm',
            ])
            ->one();

            $nty->status = 'Order Submit';

            $nty->save();

            $notification = new Notification();
            $notification->date = date('Y-m-d');
            $notification->date_time = date('Y-m-d H:i:s');
            $notification->message = $user->email.' Has Make An Order For RFQ '.$model->myRFQ;
            $notification->from_who = Yii::$app->user->identity->id;
            $notification->to_who = 'admin';
            $notification->read_unread = 1;
            $notification->status = '';
            $notification->project = $model->_id;
            $notification->path = '/project/notify';
            $notification->module = 'order';

            $notification->save();


            $model->save() && $status->save() ;

            $paypal->paymentID = $paymentID;
            $paypal->payerID = $payerID;
            $paypal->paymentToken = $paymentToken;
            $paypal->transactionID = $transacId;
            $paypal->project = $newProject_id;
            $paypal->date = date('Y-m-d');
            $paypal->date_time = date('Y-m-d H:i:s');

            $paypal->save();


            $admin = Url::to('@admin');

            $from =  Yii::$app->params['supportEmail'];
            $to = Yii::$app->params['adminEmail'];

            $subject = $user->email.' Has Make An Order For Project : '.$model->myRFQ;

            $text = 'You Have 1 Order From : '.$user->email.' <br><br> '.$admin.'/project/notify?id='.(string)$notification->_id.'&module=order';

            $newProject_id = new \MongoDB\BSON\ObjectID($model->_id);

            $mail = new Email();
            $mail->from_who = $from;
            $mail->to_who = $to;
            $mail->subject = $subject;
            $mail->text = $text;
            $mail->date_mail = date('Y-m-d');
            $mail->date_time_mail = date('Y-m-d H:i:s');
            $mail->project_id = $newProject_id;
            $mail->myRFQ = $model->myRFQ;


            $mail->save();

            Yii::$app->mailer->compose()
                ->setFrom($from)
                ->setTo($to)
                ->setSubject($subject)
                ->setHtmlBody($text)
                ->send();


            $asiax = Url::to('@asiax');

            $from_user =  Yii::$app->params['adminEmail'];
            $to_user = $user->email;

            $subject_user = 'Order Confirmation For Project No : '.$model->myRFQ;

            $text_user = 'You Order Has Been Place <br><br> You Can Download Invoice Here : '.$asiax.'/fisher/project/invoice?id='.(string)$model->_id;

            $mail = new Email();
            $mail->from_who = $from_user;
            $mail->to_who = $to_user;
            $mail->subject = $subject_user;
            $mail->text = $text_user;
            $mail->date_mail = date('Y-m-d');
            $mail->date_time_mail = date('Y-m-d H:i:s');
            $mail->project_id = $newProject_id;
            $mail->myRFQ = $model->myRFQ;

            $mail->save();

            Yii::$app->mailer->compose()
                ->setFrom($from_user)
                ->setTo($to_user)
                ->setSubject($subject_user)
                ->setHtmlBody($text_user)
                ->send();

            


            Yii::$app->session->setFlash('success_payment', 'Payment Successful');

            return $this->redirect(['/fisher/project/order-detail','project'=>(string)$newProject_id]);
    
        
        
    }

    public function actionOrderDetail($project)
    {



        $newProject_id = new \MongoDB\BSON\ObjectID($project);

        $collection = Yii::$app->mongodb->getCollection('project');
        $model = $collection->aggregate([
            [
                '$unwind' => '$data'
            ], 
            [
                '$match' => [

                    '$and' => [

                            [
                                '_id' => $newProject_id,

                            ]
                 


                    ],

                    
                ]
            ],
            [
                '$group' => [
                    '_id' => '$_id',
                    'name'  => ['$first' => '$name' ],
                    'email'  => ['$first' => '$email' ],
                    'company_name'  => ['$first' => '$company_name' ],
                    'address'  => ['$first' => '$address' ],
                    'postcode'  => ['$first' => '$postcode' ],
                    'city'  => ['$first' => '$city' ],
                    'province'  => ['$first' => '$province' ],
                    'country'  => ['$first' => '$country' ],
                    'contact_no'  => ['$first' => '$contact_no' ],
                    'currency' => ['$first' => '$currency' ],
                    'myRFQ'  => ['$first' => '$myRFQ' ],
                    'discount' => ['$first' => '$discount' ],
                    'tax' => ['$first' => '$tax' ],
                    'type_tax' => ['$first' => '$type_tax' ],
                    'in_percentage_dis' => ['$first' => '$in_percentage_dis' ],
                    'payment_type' => ['$first' => '$payment_type' ],
                    'date_payment' => ['$first' => '$date_payment' ],
                    'date_time_payment' => ['$first' => '$date_time_payment' ],
                    'total'=> ['$first' => '$total' ],
                    'diff_add_info'  => ['$first' => '$diff_add_info' ],
                    'diff_company' => ['$first' => '$diff_company' ],
                    'diff_name'  => ['$first' => '$diff_name' ],
                    'diff_address' => ['$first' => '$diff_address' ],
                    'diff_postcode' => ['$first' => '$diff_postcode' ],
                    'diff_city' => ['$first' => '$diff_city' ],
                    'diff_province' => ['$first' => '$diff_province' ],
                    'diff_country' => ['$first' => '$diff_country' ],
                    'lead_time' => ['$first' => '$lead_time' ],
                    'validity' => ['$first' => '$validity' ],


                    'data' => [
                        '$push' => [
                            'catalog_no' => '$data.catalog_no',
                            'quantity' => '$data.quantity',
                            'description' => '$data.description',
                            'price' => '$data.price',
                            'specification' => '$data.specification',
                            'item' => '$data.item',
                            'freight' => '$data.freight',
                            'freight_per_item' => '$data.freight_per_item',
                            'discount_per_item'  => '$data.discount_per_item',
                            'discount_per_item_value' => '$data.discount_per_item_value',
                            'in_percentage'  => '$data.in_percentage',
                            'remark'  => '$data.remark',
                            'per_item'  => '$data.per_item',
                            //'in_percentage' => '$data.in_percentage',
                            //'discount_per_item_value' => '$data.discount_per_item_value',
                            //'per_item' => '$data.per_item',
                            

                            
                        ],
                        
                    ],


            
                ]
            ],


        ]);





        foreach ($model as $key => $value) {
            $data = $value['data'];
            $show = $value['show'];
         }



        return $this->render('order-detail', [
            'model' => $model,
            'data' => $data,
            'show' => $show,
            'newProject_id' => $newProject_id

        ]);




    }





    public function actionTrack($id)
    {

        $newProject_id = new \MongoDB\BSON\ObjectID($id);


        $status = Status::find()
        ->where(['project' => (string)$newProject_id])
        ->all();


        $collection = Yii::$app->mongodb->getCollection('project');
        $models = $collection->aggregate([
            [
                '$unwind' => '$data'
            ], 
            [
                '$match' => [

                    '$and' => [
                            [
                                'data.choosed' => 'on'
                            ],
                            [
                                '_id' => $newProject_id,
                            ],
                            [
                                'belong_to' => Yii::$app->user->identity->id
                            ]
                 


                    ],

                    
                ]
            ],
            [
                '$group' => [
                    '_id' => '$_id',
                    'currency' => ['$first' => '$currency' ],
                    'discount' => ['$first' => '$discount' ],
                    'tax' => ['$first' => '$tax' ],
                    'date_create' => ['$first' => '$date_create' ],
                    'type_tax' => ['$first' => '$type_tax' ],
                    'myRFQ' => ['$first' => '$myRFQ' ],
                    'in_percentage_dis' => ['$first' => '$in_percentage_dis' ],
                    'name' => ['$first' => '$name' ],
                    'company_name' => ['$first' => '$company_name' ],
                    'address' => ['$first' => '$address' ],
                    'postcode' => ['$first' => '$postcode' ],
                    'city' => ['$first' => '$city' ],
                    'province' => ['$first' => '$province' ],
                    'contact_no' => ['$first' => '$contact_no' ],
                    'email' => ['$first' => '$email' ],
                    'diff_add_info' => ['$first' => '$diff_add_info' ],
                    'diff_name' => ['$first' => '$diff_name' ],
                    'diff_address' => ['$first' => '$diff_address' ],
                    'diff_postcode' => ['$first' => '$diff_postcode' ],
                    'diff_city' => ['$first' => '$diff_city' ],
                    'diff_province' => ['$first' => '$diff_province' ],
                    'diff_country' => ['$first' => '$diff_country' ],
                    'diff_contact_no' => ['$first' => '$diff_contact_no' ],
                    'reason_revise' => ['$first' => '$reason_revise' ],
                    'quotation_no' => ['$first' => '$quotation_no' ],
                    'revise' => ['$first' => '$revise' ],
                    'reviseCount' => ['$first' => '$reviseCount' ],
                    'status_item' => ['$first' => '$status_item' ],
                    'discount' => ['$first' => '$discount' ],
                    'in_percentage_dis'=> ['$first' => '$in_percentage_dis' ],
                    'data' => [
                        '$push' => [
                            'catalog_no' => '$data.catalog_no',
                            'item' => '$data.item',
                            'specification' => '$data.specification',
                            'description' => '$data.description',
                            'remark' => '$data.remark',
                            'price' => '$data.price',
                            'quantity'  => '$data.quantity',
                            'freight'  => '$data.freight',
                            'freight_per_item'  => '$data.freight_per_item',
                            'discount_per_item'  => '$data.discount_per_item',
                            'in_percentage' => '$data.in_percentage',
                            'discount_per_item_value' => '$data.discount_per_item_value',
                            'per_item' => '$data.per_item',


                        ],
                        
                    ],


            
                ]
            ],


        ]);

 

        return $this->render('track', [
            'models' => $models,
            'status' => $status,
            'newProject_id' => $newProject_id
        ]);
    }

    public function actionNotify($id,$module)
    {

        $newProject_id = new \MongoDB\BSON\ObjectID($id);

        $models = Notification::find()
        ->where(['_id' => $newProject_id])
        ->one();


        $models->read_unread = 0;
        $models->status = 'Need To Confirm';

        $models->save();

        if ($module == 'quotation') {

            return $this->redirect(['/fisher/project/review','id' => (string)$models->project]);
            
        } elseif ($module == 'order') {
            
        }

    }






}