<?php

namespace backend\controllers;

use Yii;
use common\models\Project;
use common\models\Archive;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Status;
use common\models\Notification;
use common\models\LookupStatus;
use common\models\LookupDetail;
use common\models\Email;
use backend\models\Fisher;
use backend\models\OcAddress;
use common\models\User;
use common\models\Asiaebuy;
use yii\db\Query;
use yii\helpers\Url;
/**
 * ProjectController implements the CRUD actions for Project model.
 */
class ProjectController extends Controller
{


	public function actionIndex()
    {
        $models = Project::find()
        ->where(['status' => 'Submit'])
        ->orderBy(['myRFQ' => SORT_DESC])
        ->all();


        return $this->render('index', [
            'models' => $models,
        ]);
    }

    public function actionCheckPrice()
    {
        $catalog_no = $_POST['ctg'];
        $id = (string)$_POST['id'];


        $modelsData = Project::find()
        ->where(['status' => 'Submit','_id'=>$id])
        ->one();

        $user = User::find()->where(['_id' => $modelsData->belong_to])->one();

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
        $address = $command2->queryAll();


        $connection = \Yii::$app->db;
        $sql = $connection->createCommand("SELECT *,COUNT(catalog_no) as duplicate FROM fisher WHERE SUBSTRING(catalog_no,5) = '".$catalog_no."'");
        $checkVar = $sql->queryAll();


        foreach ($checkVar as $key_fisher => $value_fisher) {


            $fisherNew = Fisher::find()->where(['catalog_no' => $value_fisher['catalog_no']])->all();


            foreach ($fisherNew as $key_new => $value_new) {

                if ($address[0]['country_id'] == 129) {

                    $priceFisher = $value_new['local_myr'];


                } elseif ($address[0]['country_id'] == 209 || $address[0]['country_id'] == 100 || $address[0]['country_id'] == 168 || $address[0]['country_id'] == 230 || $address[0]['country_id'] == 188 || $address[0]['country_id'] == 36 || $address[0]['country_id'] == 116 || $address[0]['country_id'] == 32) {

                    $priceFisher = $value_new['asean_usd'];

                } else {

                    $priceFisher = $value_new['asiapac_usd'];

                }

                $data = array();
                $data[0] = $priceFisher;
                $data[1] = $value_new['desc'];
                $data[2] = $value_new['desc_long Description'];

                echo json_encode($data);


            }

        }



    }



    public function actionQuote($id)
    {

        $modelsData = Project::find()
        ->where(['status' => 'Submit','_id'=>$id])
        ->one();

        $asiaebuy = Asiaebuy::find()->one();

        $user = User::find()->where(['_id' => $modelsData->belong_to])->one();

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
        $address = $command2->queryAll();

        

        $check = Project::find()
        ->orderBy([
           'quotation_no'=>SORT_DESC,
        ])
        ->limit(1)
        ->all();

        foreach ($check as $key => $value) {
            $temp = $value['quotation_no'];
        }


        $runningNo = $temp;

        $no = 1000;

        if (empty($runningNo)) {
           
            $modelsData->quotation_no = $no;
            $modelsData->date_quotation = date('Y-m-d');
            $modelsData->date_time_quotation = date('Y-m-d H:i:s');


            foreach ($modelsData['data'] as $key => $value) {

                $connection = \Yii::$app->db;
                $sql = $connection->createCommand("SELECT *,COUNT(catalog_no) as duplicate FROM fisher WHERE SUBSTRING(catalog_no,5) = '".$value['catalog_no']."'");
                $checkVar = $sql->queryAll();

                foreach ($checkVar as $key_fisher => $value_fisher) {


                    if ($value_fisher['duplicate'] != 0) {


                        $fisherNew = Fisher::find()->where(['catalog_no' => $value_fisher['catalog_no']])->all();
                        
                        foreach ($fisherNew as $key_new => $value_new) {

                            if ($address[0]['country_id'] == 129) {

                                $priceFisher = $value_new['local_myr'];

  
                            } elseif ($address[0]['country_id'] == 209 || $address[0]['country_id'] == 100 || $address[0]['country_id'] == 168 || $address[0]['country_id'] == 230 || $address[0]['country_id'] == 188 || $address[0]['country_id'] == 36 || $address[0]['country_id'] == 116 || $address[0]['country_id'] == 32) {

                                $priceFisher = $value_new['asean_usd'];
              
                            } else {

                                $priceFisher = $value_new['asiapac_usd'];

                            }


                            $collection = Yii::$app->mongodb->getCollection('project');
                            $arrUpdateD = [
                                '$push' => [
                                    'data' => [
                                        'catalog_no' => $value_new['catalog_no'],
                                        'quantity' => $value['quantity'],
                                        'description' => $value_new['desc'],
                                        'price' => $priceFisher,

                                    ]

                                ]
                            
                            ];
                            $collection->update(['_id' => $id],$arrUpdateD);
                            
                        }

                            $collection = Yii::$app->mongodb->getCollection('project');
                            $arrUpdate = [
                                '$pull' => [
                                    'data' => [
                                        'catalog_no' => substr($value_new['catalog_no'],4)
                                    ]
                                ],

                            
                            ];
                            $collection->update(['_id' => $id],$arrUpdate);

                    } else {

                        $fisherNew = Fisher::find()->where(['catalog_no' => $value_fisher['catalog_no']])->all();
                        
                        foreach ($fisherNew as $key_new => $value_new) {

                                $collection = Yii::$app->mongodb->getCollection('project');
                                $arrUpdateD = [
                                    '$push' => [
                                        'data' => [
                                            'catalog_no' => $value['catalog_no'],
                                            'quantity' => $value['quantity'],
                                            'description' => $value['desc'],
                       

                                        ]

                                    ]
                                
                                ];
                                $collection->update(['_id' => $id],$arrUpdateD);
                            

                        }




                    }


                }


    
            }



        } else {

            if (empty($modelsData->quotation_no)) {
                    
                $modelsData->quotation_no = $runningNo + 1;
                $modelsData->date_quotation = date('Y-m-d');
                $modelsData->date_time_quotation = date('Y-m-d H:i:s');


                    foreach ($modelsData['data'] as $key => $value) {

                        $connection = \Yii::$app->db;
                        $sql = $connection->createCommand("SELECT *,COUNT(catalog_no) as duplicate FROM fisher WHERE SUBSTRING(catalog_no,5) = '".$value['catalog_no']."'");
                        $checkVar = $sql->queryAll();

                        foreach ($checkVar as $key_fisher => $value_fisher) {


                            if ($value_fisher['duplicate'] != 0) {


                                $fisherNew = Fisher::find()->where(['catalog_no' => $value_fisher['catalog_no']])->all();
                                
                                foreach ($fisherNew as $key_new => $value_new) {

                                    if ($address[0]['country_id'] == 129) {

                                        $priceFisher = $value_new['local_myr'];

          
                                    } elseif ($address[0]['country_id'] == 209 || $address[0]['country_id'] == 100 || $address[0]['country_id'] == 168 || $address[0]['country_id'] == 230 || $address[0]['country_id'] == 188 || $address[0]['country_id'] == 36 || $address[0]['country_id'] == 116 || $address[0]['country_id'] == 32) {

                                        $priceFisher = $value_new['asean_usd'];
                      
                                    } else {

                                        $priceFisher = $value_new['asiapac_usd'];

                                    }


                                    $collection = Yii::$app->mongodb->getCollection('project');
                                    $arrUpdateD = [
                                        '$push' => [
                                            'data' => [
                                                'catalog_no' => $value_new['catalog_no'],
                                                'quantity' => $value['quantity'],
                                                'description' => $value_new['desc'],
                                                'price' => $priceFisher,

                                            ]

                                        ]
                                    
                                    ];
                                    $collection->update(['_id' => $id],$arrUpdateD);
                                    



                                }

                                    $collection = Yii::$app->mongodb->getCollection('project');
                                    $arrUpdate = [
                                        '$pull' => [
                                            'data' => [
                                                'catalog_no' => $value['catalog_no']
                                            ]
                                        ],

                                    
                                    ];
                                    $collection->update(['_id' => $id],$arrUpdate);


                                


                            } else {


                                $fisherNew = Fisher::find()->where(['catalog_no' => $value_fisher['catalog_no']])->all();
                                
                                foreach ($fisherNew as $key_new => $value_new) {

            
                                    $collection = Yii::$app->mongodb->getCollection('project');
                                    $arrUpdateD = [
                                        '$push' => [
                                            'data' => [
                                                'catalog_no' => $value['catalog_no'],
                                                'quantity' => $value['quantity'],
                                                'description' => $value['desc'],
                           

                                            ]

                                        ]
                                    
                                    ];
                                    $collection->update(['_id' => $id],$arrUpdateD);
                                    



                                }

       


                                

                            }





                        }


                


                    }


            } elseif (!empty($modelsData->quotation_no)) {
                

            }
    

        }

        $modelsData->save();


        $models = Project::find()
        ->where(['status' => 'Submit','_id'=>$id])
        ->one();

        return $this->render('quote', [
            'models' => $models,
            'asiaebuy' => $asiaebuy,
        ]);

    }

    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionCurrency()
    {

        $model = Project::find()
        ->where(['_id'=>$_POST['project']])
        ->one();

        $model->currency = $_POST['val'];
        $model->save();

    }



    public function actionValidity($project,$location)
    {
        $model = Project::find()
        ->where(['_id'=>$project])
        ->one();

        if ($model->load(Yii::$app->request->post()) ) {

            $model->validity = empty($_POST['Project']['validity']) ? '': $_POST['Project']['validity'];

            $model->save();

            Yii::$app->session->setFlash('validity', 'Validity Added');

            if ($location == 'revise') {

                return $this->redirect(['/project/revise','project' => (string)$project]);
               
            } elseif ($location == 'quote') {

               return $this->redirect(['/project/quote','id' => (string)$project]);

            } 

        } else {

            return $this->renderAjax('validity', [
                'model' => $model,
            ]);

        }

    }

    public function actionLead($project,$location)
    {
        $model = Project::find()
        ->where(['_id'=>$project])
        ->one();

        if ($model->load(Yii::$app->request->post()) ) {

            $model->lead_time = empty($_POST['Project']['lead_time']) ? '': $_POST['Project']['lead_time'];

            $model->save();

            Yii::$app->session->setFlash('lead', 'Lead Time Added');

            if ($location == 'revise') {

                return $this->redirect(['/project/revise','project' => (string)$project]);
               
            } elseif ($location == 'quote') {

               return $this->redirect(['/project/quote','id' => (string)$project]);

            } 



        } else {

            return $this->renderAjax('lead', [
                'model' => $model,
            ]);

        }

    }

    public function actionRemark($project,$location)
    {
        $model = Project::find()
        ->where(['_id'=>$project])
        ->one();

        if ($model->load(Yii::$app->request->post()) ) {

            $model->remark_all = empty($_POST['Project']['remark_all']) ? '': $_POST['Project']['remark_all'];

            $model->save();

            Yii::$app->session->setFlash('remark', 'Remark Added');

            if ($location == 'revise') {

                return $this->redirect(['/project/revise','project' => (string)$project]);
               
            } elseif ($location == 'quote') {

               return $this->redirect(['/project/quote','id' => (string)$project]);

            } 



        } else {

            return $this->renderAjax('remark', [
                'model' => $model,
            ]);

        }

    }

    public function actionDiscount($project,$location)
    {
        $model = Project::find()
        ->where(['_id'=>$project])
        ->one();

        if ($model->load(Yii::$app->request->post()) ) {

            $model->in_percentage_dis = empty($_POST['Project']['in_percentage_dis']) ? '': $_POST['Project']['in_percentage_dis'];
            $model->discount = empty($_POST['Project']['discount']) ? '': $_POST['Project']['discount'];

            $model->save();

            Yii::$app->session->setFlash('discount', 'Discount Added');

            if ($location == 'revise') {

                return $this->redirect(['/project/revise','project' => (string)$project]);
               
            } elseif ($location == 'quote') {

               return $this->redirect(['/project/quote','id' => (string)$project]);

            } 



        } else {

            return $this->renderAjax('discount', [
                'model' => $model,
            ]);

        }

    }

    public function actionTax($project,$location)
    {
        $model = Project::find()
        ->where(['_id'=>$project])
        ->one();

        if ($model->load(Yii::$app->request->post()) ) {

            $model->type_tax = empty($_POST['Project']['type_tax']) ? '': $_POST['Project']['type_tax'];
            $model->tax = empty($_POST['Project']['tax']) ? '': $_POST['Project']['tax'];

            $model->save();

            Yii::$app->session->setFlash('tax', 'Tax Added');

            if ($location == 'revise') {

                return $this->redirect(['/project/revise','project' => (string)$project]);
               
            } elseif ($location == 'quote') {

               return $this->redirect(['/project/quote','id' => (string)$project]);

            } 



        } else {

            return $this->renderAjax('tax', [
                'model' => $model,
            ]);

        }

    }

    public function actionAdd($project,$location)
    {
        $model = Project::find()
        ->where(['_id'=>$project])
        ->one();



        if ($model->load(Yii::$app->request->post()) ) {


            if (empty($_POST['Project']['data']['catalog_no'])) {
                
                $catalog_no = '';

            } else {

                $connection = \Yii::$app->db;
                $sql = $connection->createCommand("SELECT *,COUNT(catalog_no) as duplicate FROM fisher WHERE SUBSTRING(catalog_no,5) = '".$_POST['Project']['data']['catalog_no']."'");
                $checkVar = $sql->queryAll();


                foreach ($checkVar as $key_fisher => $value_fisher) {


                    if ($value_fisher['duplicate'] != 0) {

                        $fisherNew = Fisher::find()->where(['catalog_no' => $value_fisher['catalog_no']])->all();

                        foreach ($fisherNew as $key_new => $value_new) {

                            $catalog_no = $value_new['catalog_no'];

                        }


                    } else {


                            $catalog_no =  empty($_POST['Project']['data']['catalog_no']) ? '': $_POST['Project']['data']['catalog_no'];


                    }

                }



            }




            $dt = count($model->data);

            $collection = Yii::$app->mongodb->getCollection('project');
            if ($dt == 0) {

                if ($_POST['Project']['data']['discount_per_item'] == 'No') {

                    $arrUpdate = [
                        '$set' => [
                    
                            'data.$.item' => empty($_POST['Project']['data']['item']) ? '': $_POST['Project']['data']['item'], 
                            'data.$.catalog_no' => $catalog_no,
                            'data.$.specification' => empty($_POST['Project']['data']['specification']) ? '': $_POST['Project']['data']['specification'], 
                            'data.$.description' => empty($_POST['Project']['data']['description']) ? '': $_POST['Project']['data']['description'], 
                            'data.$.quantity' => empty($_POST['Project']['data']['quantity']) ? 0: $_POST['Project']['data']['quantity'], 
                            'data.$.price' => empty($_POST['Project']['data']['price']) ? 0: $_POST['Project']['data']['price'], 
                            'data.$.freight' => empty($_POST['Project']['data']['freight']) ? 0: $_POST['Project']['data']['freight'], 
                            'data.$.freight_per_item' => empty($_POST['Project']['data']['freight_per_item']) ? '': $_POST['Project']['data']['freight_per_item'], 
                            'data.$.discount_per_item' => 'No',
                            'data.$.discount_per_item_value' => 0,
                            'data.$.in_percentage' => 'No',
                            'data.$.remark' => empty($_POST['Project']['data']['remark']) ? '': $_POST['Project']['data']['remark'], 
                            'data.$.per_item' => 'No',


                        ]
                    
                    ];


                } elseif ($_POST['Project']['data']['discount_per_item'] == 'Yes') {


                    if ($_POST['Project']['data']['in_percentage'] == 'Yes') {

                        $arrUpdate = [
                            '$set' => [
                        
                                'data.$.item' => empty($_POST['Project']['data']['item']) ? '': $_POST['Project']['data']['item'], 
                                'data.$.catalog_no' => $catalog_no,
                                'data.$.specification' => empty($_POST['Project']['data']['specification']) ? '': $_POST['Project']['data']['specification'], 
                                'data.$.description' => empty($_POST['Project']['data']['description']) ? '': $_POST['Project']['data']['description'], 
                                'data.$.quantity' => empty($_POST['Project']['data']['quantity']) ? 0: $_POST['Project']['data']['quantity'], 
                                'data.$.price' => empty($_POST['Project']['data']['price']) ? 0: $_POST['Project']['data']['price'], 
                                'data.$.freight' => empty($_POST['Project']['data']['freight']) ? 0: $_POST['Project']['data']['freight'], 
                                'data.$.freight_per_item' => empty($_POST['Project']['data']['freight_per_item']) ? '': $_POST['Project']['data']['freight_per_item'], 
                                'data.$.discount_per_item' => 'Yes',
                                'data.$.discount_per_item_value' => empty($_POST['Project']['data']['discount_per_item_value']) ? 0: $_POST['Project']['data']['discount_per_item_value'], 
                                'data.$.in_percentage' => 'Yes',
                                'data.$.remark' => empty($_POST['Project']['data']['remark']) ? '': $_POST['Project']['data']['remark'], 
                                'data.$.per_item' => 'No',


                            ]
                        
                        ];


                    } elseif ($_POST['Project']['data']['in_percentage'] == 'No') {

                        $arrUpdate = [
                            '$set' => [
                        
                                'data.$.item' => empty($_POST['Project']['data']['item']) ? '': $_POST['Project']['data']['item'], 
                                'data.$.catalog_no' => $catalog_no,
                                'data.$.specification' => empty($_POST['Project']['data']['specification']) ? '': $_POST['Project']['data']['specification'], 
                                'data.$.description' => empty($_POST['Project']['data']['description']) ? '': $_POST['Project']['data']['description'], 
                                'data.$.quantity' => empty($_POST['Project']['data']['quantity']) ? 0: $_POST['Project']['data']['quantity'], 
                                'data.$.price' => empty($_POST['Project']['data']['price']) ? 0: $_POST['Project']['data']['price'], 
                                'data.$.freight' => empty($_POST['Project']['data']['freight']) ? 0: $_POST['Project']['data']['freight'], 
                                'data.$.freight_per_item' => empty($_POST['Project']['data']['freight_per_item']) ? '': $_POST['Project']['data']['freight_per_item'], 
                                'data.$.discount_per_item' => 'Yes',
                                'data.$.discount_per_item_value' => empty($_POST['Project']['data']['discount_per_item_value']) ? 0: $_POST['Project']['data']['discount_per_item_value'], 
                                'data.$.in_percentage' => 'No',
                                'data.$.remark' => empty($_POST['Project']['data']['remark']) ? '': $_POST['Project']['data']['remark'], 
                                'data.$.per_item' => empty($_POST['Project']['data']['per_item']) ? '': $_POST['Project']['data']['per_item'],


                            ]
                        
                        ];


  
                    }



                }


                $collection->update(['_id' => $project],$arrUpdate);

                
            } else {


                if ($_POST['Project']['data']['discount_per_item'] == 'No') {


                    $arrUpdate = [
                        '$push' => [
                            'data' => [
                                
                                    'item' => empty($_POST['Project']['data']['item']) ? '': $_POST['Project']['data']['item'], 
                                    'catalog_no' => $catalog_no,
                                    'specification' => empty($_POST['Project']['data']['specification']) ? '': $_POST['Project']['data']['specification'], 
                                    'description' => empty($_POST['Project']['data']['description']) ? '': $_POST['Project']['data']['description'], 
                                    'quantity' => empty($_POST['Project']['data']['quantity']) ? 0 : $_POST['Project']['data']['quantity'], 
                                    'price' => empty($_POST['Project']['data']['price']) ? 0: $_POST['Project']['data']['price'], 
                                    'freight' => empty($_POST['Project']['data']['freight']) ? 0: $_POST['Project']['data']['freight'], 
                                    'freight_per_item' => empty($_POST['Project']['data']['freight_per_item']) ? '': $_POST['Project']['data']['freight_per_item'], 
                                    'discount_per_item' => 'No',
                                    'discount_per_item_value' => 0,
                                    'in_percentage' => 'No',
                                    'remark' => empty($_POST['Project']['data']['remark']) ? '': $_POST['Project']['data']['remark'], 
                                    'per_item' => 'No',

                                
                            ],

                        ]
                    
                    ];


                } elseif ($_POST['Project']['data']['discount_per_item'] == 'Yes') {


                    if ($_POST['Project']['data']['in_percentage'] == 'Yes') {


                            $arrUpdate = [
                                '$push' => [
                                    'data' => [
                                        
                                            'item' => empty($_POST['Project']['data']['item']) ? '': $_POST['Project']['data']['item'], 
                                            'catalog_no' => $catalog_no, 
                                            'specification' => empty($_POST['Project']['data']['specification']) ? '': $_POST['Project']['data']['specification'], 
                                            'description' => empty($_POST['Project']['data']['description']) ? '': $_POST['Project']['data']['description'], 
                                            'quantity' => empty($_POST['Project']['data']['quantity']) ? 0 : $_POST['Project']['data']['quantity'], 
                                            'price' => empty($_POST['Project']['data']['price']) ? 0: $_POST['Project']['data']['price'], 
                                            'freight' => empty($_POST['Project']['data']['freight']) ? 0: $_POST['Project']['data']['freight'], 
                                            'freight_per_item' => empty($_POST['Project']['data']['freight_per_item']) ? '': $_POST['Project']['data']['freight_per_item'], 
                                            'discount_per_item' => 'Yes',
                                            'discount_per_item_value' => empty($_POST['Project']['data']['discount_per_item_value']) ? 0: $_POST['Project']['data']['discount_per_item_value'], 
                                            'in_percentage' => 'Yes',
                                            'remark' => empty($_POST['Project']['data']['remark']) ? '': $_POST['Project']['data']['remark'], 
                                            'per_item' => 'No',


                                        
                                    ],

                                ]
                            
                            ];


                    } elseif ($_POST['Project']['data']['in_percentage'] == 'No') {


                            $arrUpdate = [
                                '$push' => [
                                    'data' => [
                                        
                                            'item' => empty($_POST['Project']['data']['item']) ? '': $_POST['Project']['data']['item'], 
                                            'catalog_no' => $catalog_no,
                                            'specification' => empty($_POST['Project']['data']['specification']) ? '': $_POST['Project']['data']['specification'], 
                                            'description' => empty($_POST['Project']['data']['description']) ? '': $_POST['Project']['data']['description'], 
                                            'quantity' => empty($_POST['Project']['data']['quantity']) ? 0 : $_POST['Project']['data']['quantity'], 
                                            'price' => empty($_POST['Project']['data']['price']) ? 0: $_POST['Project']['data']['price'], 
                                            'freight' => empty($_POST['Project']['data']['freight']) ? 0: $_POST['Project']['data']['freight'], 
                                            'freight_per_item' => empty($_POST['Project']['data']['freight_per_item']) ? '': $_POST['Project']['data']['freight_per_item'], 
                                            'discount_per_item' => 'Yes',
                                            'discount_per_item_value' => empty($_POST['Project']['data']['discount_per_item_value']) ? 0: $_POST['Project']['data']['discount_per_item_value'], 
                                            'in_percentage' => 'No',
                                            'remark' => empty($_POST['Project']['data']['remark']) ? '': $_POST['Project']['data']['remark'], 
                                            'per_item' => empty($_POST['Project']['data']['per_item']) ? '': $_POST['Project']['data']['per_item'],

                                
                                    ],

                                ]
                            
                            ];






                    }



                }

                $collection->update(['_id' => $project],$arrUpdate);




            }


            Yii::$app->session->setFlash('save', 'Item Added');

            if ($location == 'revise') {

                return $this->redirect(['/project/revise','project' => (string)$project]);
               
            } elseif ($location == 'quote') {

               return $this->redirect(['/project/quote','id' => (string)$project]);

            } 


        } else {

            return $this->renderAjax('add', [
                'model' => $model,
            ]);

        }


    
    }

    public function actionEdit($arrayItem,$project,$catalog_no,$location)
    {

        $model = Project::find()
        ->where(['_id'=>$project])
        ->one();

        $collection = Yii::$app->mongodb->getCollection('project');
        $modelItem = $collection->aggregate([
            [
                '$unwind' => '$data'
            ],
            [
                '$match' => [
                    '_id' => $project,
                    'data.catalog_no' => $catalog_no,
                ]
            ],

        ]); 





        if ($model->load(Yii::$app->request->post()) ) {


            if (empty($_POST['Project']['data']['catalog_no'])) {
                
                $catalog_no = '';

            } else {

                $connection = \Yii::$app->db;
                $sql = $connection->createCommand("SELECT *,COUNT(catalog_no) as duplicate FROM fisher WHERE SUBSTRING(catalog_no,5) = '".$_POST['Project']['data']['catalog_no']."'");
                $checkVar = $sql->queryAll();


                foreach ($checkVar as $key_fisher => $value_fisher) {


                    if ($value_fisher['duplicate'] != 0) {

                        $fisherNew = Fisher::find()->where(['catalog_no' => $value_fisher['catalog_no']])->all();

                        foreach ($fisherNew as $key_new => $value_new) {

                            $catalog_no = $value_new['catalog_no'];

                        }


                    } else {


                            $catalog_no =  empty($_POST['Project']['data']['catalog_no']) ? '': $_POST['Project']['data']['catalog_no'];


                    }

                }



            }



                if ($_POST['Project']['data']['discount_per_item'] == 'No') {

                    $arrUpdate = [
                        '$set' => [
                    
                            'data.$.item' => empty($_POST['Project']['data']['item']) ? '': $_POST['Project']['data']['item'], 
                            'data.$.catalog_no' => $catalog_no, 
                            'data.$.specification' => empty($_POST['Project']['data']['specification']) ? '': $_POST['Project']['data']['specification'], 
                            'data.$.description' => empty($_POST['Project']['data']['description']) ? '': $_POST['Project']['data']['description'], 
                            'data.$.quantity' => empty($_POST['Project']['data']['quantity']) ? 0: $_POST['Project']['data']['quantity'], 
                            'data.$.price' => empty($_POST['Project']['data']['price']) ? 0: $_POST['Project']['data']['price'], 
                            'data.$.freight' => empty($_POST['Project']['data']['freight']) ? 0: $_POST['Project']['data']['freight'], 
                            'data.$.freight_per_item' => empty($_POST['Project']['data']['freight_per_item']) ? '': $_POST['Project']['data']['freight_per_item'], 
                            'data.$.discount_per_item' => 'No',
                            'data.$.discount_per_item_value' => 0,
                            'data.$.in_percentage' => 'No',
                            'data.$.remark' => empty($_POST['Project']['data']['remark']) ? '': $_POST['Project']['data']['remark'], 
                            'data.$.per_item' => 'No',


                        ]
                    
                    ];


                } elseif ($_POST['Project']['data']['discount_per_item'] == 'Yes') {


                    if ($_POST['Project']['data']['in_percentage'] == 'Yes') {

                        $arrUpdate = [
                            '$set' => [
                        
                                'data.$.item' => empty($_POST['Project']['data']['item']) ? '': $_POST['Project']['data']['item'], 
                                'data.$.catalog_no' => $catalog_no, 
                                'data.$.specification' => empty($_POST['Project']['data']['specification']) ? '': $_POST['Project']['data']['specification'], 
                                'data.$.description' => empty($_POST['Project']['data']['description']) ? '': $_POST['Project']['data']['description'], 
                                'data.$.quantity' => empty($_POST['Project']['data']['quantity']) ? 0: $_POST['Project']['data']['quantity'], 
                                'data.$.price' => empty($_POST['Project']['data']['price']) ? 0: $_POST['Project']['data']['price'], 
                                'data.$.freight' => empty($_POST['Project']['data']['freight']) ? 0: $_POST['Project']['data']['freight'], 
                                'data.$.freight_per_item' => empty($_POST['Project']['data']['freight_per_item']) ? '': $_POST['Project']['data']['freight_per_item'], 
                                'data.$.discount_per_item' => 'Yes',
                                'data.$.discount_per_item_value' => empty($_POST['Project']['data']['discount_per_item_value']) ? 0: $_POST['Project']['data']['discount_per_item_value'], 
                                'data.$.in_percentage' => 'Yes',
                                'data.$.remark' => empty($_POST['Project']['data']['remark']) ? '': $_POST['Project']['data']['remark'], 
                                'data.$.per_item' => 'No',


                            ]
                        
                        ];


                    } elseif ($_POST['Project']['data']['in_percentage'] == 'No') {

                        $arrUpdate = [
                            '$set' => [
                        
                                'data.$.item' => empty($_POST['Project']['data']['item']) ? '': $_POST['Project']['data']['item'], 
                                'data.$.catalog_no' => $catalog_no,  
                                'data.$.specification' => empty($_POST['Project']['data']['specification']) ? '': $_POST['Project']['data']['specification'], 
                                'data.$.description' => empty($_POST['Project']['data']['description']) ? '': $_POST['Project']['data']['description'], 
                                'data.$.quantity' => empty($_POST['Project']['data']['quantity']) ? 0: $_POST['Project']['data']['quantity'], 
                                'data.$.price' => empty($_POST['Project']['data']['price']) ? 0: $_POST['Project']['data']['price'], 
                                'data.$.freight' => empty($_POST['Project']['data']['freight']) ? 0: $_POST['Project']['data']['freight'], 
                                'data.$.freight_per_item' => empty($_POST['Project']['data']['freight_per_item']) ? '': $_POST['Project']['data']['freight_per_item'], 
                                'data.$.discount_per_item' => 'Yes',
                                'data.$.discount_per_item_value' => empty($_POST['Project']['data']['discount_per_item_value']) ? 0: $_POST['Project']['data']['discount_per_item_value'], 
                                'data.$.in_percentage' => 'No',
                                'data.$.remark' => empty($_POST['Project']['data']['remark']) ? '': $_POST['Project']['data']['remark'], 
                                'data.$.per_item' => empty($_POST['Project']['data']['per_item']) ? '': $_POST['Project']['data']['per_item'],


                            ]
                        
                        ];


  
                    }



                }





                /*
                $arrUpdate = [
                    '$set' => [
                
                        'data.$.item' => empty($_POST['Project']['data']['item']) ? '': $_POST['Project']['data']['item'], 
                        'data.$.catalog_no' => empty($_POST['Project']['data']['catalog_no']) ? '': $_POST['Project']['data']['catalog_no'], 
                        'data.$.specification' => empty($_POST['Project']['data']['specification']) ? '': $_POST['Project']['data']['specification'], 
                        'data.$.description' => empty($_POST['Project']['data']['description']) ? '': $_POST['Project']['data']['description'], 
                        'data.$.quantity' => empty($_POST['Project']['data']['quantity']) ? 0: $_POST['Project']['data']['quantity'], 
                        'data.$.price' => empty($_POST['Project']['data']['price']) ? 0: $_POST['Project']['data']['price'], 
                        'data.$.freight' => empty($_POST['Project']['data']['freight']) ? 0: $_POST['Project']['data']['freight'], 
                        'data.$.freight_per_item' => empty($_POST['Project']['data']['freight_per_item']) ? '': $_POST['Project']['data']['freight_per_item'], 
                        'data.$.discount_per_item' => empty($_POST['Project']['data']['discount_per_item']) ? '': $_POST['Project']['data']['discount_per_item'], 
                        'data.$.discount_per_item_value' => empty($_POST['Project']['data']['discount_per_item_value']) ? 0: $_POST['Project']['data']['discount_per_item_value'], 

                        'data.$.in_percentage' => empty($_POST['Project']['data']['in_percentage']) ? '': $_POST['Project']['data']['in_percentage'],
                        'data.$.remark' => empty($_POST['Project']['data']['remark']) ? '': $_POST['Project']['data']['remark'], 
                        'data.$.per_item' => empty($_POST['Project']['data']['per_item']) ? '': $_POST['Project']['data']['per_item'],


                    ]
                
                ]; */



                $collection->update(['_id' => $project,'data.catalog_no'=>$catalog_no],$arrUpdate);

            Yii::$app->session->setFlash('edit', 'Item Info Edit');

            if ($location == 'revise') {

                return $this->redirect(['/project/revise','project' => (string)$project]);
               
            } elseif ($location == 'quote') {

               return $this->redirect(['/project/quote','id' => (string)$project]);

            } 



        } else {

            return $this->renderAjax('edit', [
                'model' => $model,
                'modelItem' => $modelItem,
            ]);

        }
    }

    public function actionDelete($project,$catalog_no,$location)
    {


        $collection = Yii::$app->mongodb->getCollection('project');
        $modelItem = $collection->aggregate([
            [
                '$unwind' => '$data'
            ],
            [
                '$match' => [
                    '_id' => $project,
                    'data.catalog_no' => $catalog_no,
                ]
            ],

        ]); 

    
        $arrUpdate = [
            '$pull' => [
                'data' => [
                    'catalog_no' => $catalog_no
                ]
                
               
            ]

        ];
        $collection->update(['_id' => $project],$arrUpdate);

        Yii::$app->session->setFlash('delete', 'Data Deleted');

            if ($location == 'revise') {

                return $this->redirect(['/project/revise','project' => (string)$project]);
               
            } elseif ($location == 'quote') {

               return $this->redirect(['/project/quote','id' => (string)$project]);

            } 

    }

    public function actionArchive($project,$total,$location)
    {

        $modelProject = Project::find()
        ->where(['_id'=>$project])
        ->one();

        if ($location == 'revise') {

            $modelProject->status = 'Quoted';
            $modelProject->revise = 'No';
            $modelProject->total = $total;
            $modelProject->save();

    
        } elseif ($location == 'quote') {

            $modelProject->status = 'Quoted';
            $modelProject->total = $total;
            $modelProject->save();

        }



        $collection = Yii::$app->mongodb->getCollection('project');
        $modelItem = $collection->aggregate([
            [
                '$match' => [
                    '_id' => $project,
                ]
            ],

        ]); 

        $dataArchive = serialize($modelItem);


        $collectionArchive = Yii::$app->mongodb->getCollection('archive');
        $collectionArchive->insert(
            [
                'data_archive' => unserialize($dataArchive),
                'date_archive' => date('Y-m-d'),
                'date_time_archive' => date('Y-m-d H:i:s'),

            ]);

        
        $newProject_id = new \MongoDB\BSON\ObjectID($project);

        $nty = Notification::find()
        ->where([
            'project' => $newProject_id,
            'status' => 'In Progress Quotation',
        ])
        ->one();

        $nty->status = 'Quotation Generate';

        $nty->save();


        $notification = new Notification();
        $notification->date = date('Y-m-d');
        $notification->date_time = date('Y-m-d H:i:s');
        $notification->message = 'You Received Quotation For RFQ : '.$modelProject->myRFQ;
        $notification->from_who = 'admin';
        $notification->to_who = $modelProject->email;
        $notification->read_unread = 1;
        $notification->status = '';
        $notification->project = $modelProject->_id;
        $notification->path = '/fisher/project/notify';
        $notification->module = 'quotation';

        $notification->save();

            $asia = Url::to('@asiax');

            $from =  Yii::$app->params['adminEmail'];
            $to = $modelProject->email;

            $subject = 'Quotation For Project : '.$modelProject->myRFQ;

            $text = 'You Have 1 Quotation For Project : '.$modelProject->myRFQ.' <br><br> '.$asia.'/fisher/project/notify?id='.(string)$notification->_id.'&module=quotation';

            $mail = new Email();
            $mail->from_who = $from;
            $mail->to_who = $to;
            $mail->subject = $subject;
            $mail->text = $text;
            $mail->date_mail = date('Y-m-d');
            $mail->date_time_mail = date('Y-m-d H:i:s');

            $mail->save();

            Yii::$app->mailer->compose()
                ->setFrom($from)
                ->setTo($to)
                ->setSubject($subject)
                ->setHtmlBody($text)
                ->send();


        return $this->redirect(['/project/quotation']);
    }

    public function actionArchiveRevise($project,$total,$location)
    {

        $modelProject = Project::find()
        ->where(['_id'=>$project])
        ->one();

        if ($location == 'revise') {

            $modelProject->status = 'Quoted';
            $modelProject->revise = 'No';
            $modelProject->total = $total;
            $modelProject->save();

    
        } elseif ($location == 'quote') {

            $modelProject->status = 'Quoted';
            $modelProject->total = $total;
            $modelProject->save();

        }



        $collection = Yii::$app->mongodb->getCollection('project');
        $modelItem = $collection->aggregate([
            [
                '$match' => [
                    '_id' => $project,
                ]
            ],

        ]); 

        $dataArchive = serialize($modelItem);


        $collectionArchive = Yii::$app->mongodb->getCollection('archive');
        $collectionArchive->insert(
            [
                'data_archive' => unserialize($dataArchive),
                'date_archive' => date('Y-m-d'),
                'date_time_archive' => date('Y-m-d H:i:s'),

            ]);


            $asia = Url::to('@asiax');

            $from =  Yii::$app->params['adminEmail'];
            $to = $modelProject->email;

            $subject = 'Quotation : '.$modelProject->quotation_no.' For Project : '.$modelProject->myRFQ.' Has Been Revise';

            $text = 'Quotation : '.$modelProject->quotation_no.' For Project : '.$modelProject->myRFQ.' Has Been Revise <br><br> '.$asia.'/fisher/project/review?id='.(string)$project;

            $mail = new Email();
            $mail->from_who = $from;
            $mail->to_who = $to;
            $mail->subject = $subject;
            $mail->text = $text;
            $mail->date_mail = date('Y-m-d');
            $mail->date_time_mail = date('Y-m-d H:i:s');

            $mail->save();

            Yii::$app->mailer->compose()
                ->setFrom($from)
                ->setTo($to)
                ->setSubject($subject)
                ->setHtmlBody($text)
                ->send();





        return $this->redirect(['/project/quotation']);
    }





    public function actionQuotation()
    {


        $models = Project::find()
        ->orderBy(['myRFQ' => SORT_DESC])
        ->andWhere(['or',
           ['status'=> 'Quoted'],
           ['status'=> 'Order Placed']
        ])->all();


        return $this->render('quotation', [
            'models' => $models,
        ]);


    }

    public function actionView($id)
    {
        $asiaebuy = Asiaebuy::find()->one();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'asiaebuy' => $asiaebuy,
        ]);
    }

    public function actionInvoice($id)
    {
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

    public function actionReason($project)
    {

        $model = Project::find()
        ->where(['_id'=>$project])
        ->one();


        if ($model->load(Yii::$app->request->post()) ) {

            $count = 0;
            if (empty($model->reviseCount)) {

                $model->revise = 'Yes';
                $model->reviseCount = $count+1;
               
            } else {


                $model->revise = 'Yes';
                $model->reviseCount = $model->reviseCount+1;


            }

            $model->reason_revise = empty($_POST['Project']['reason_revise']) ? '': $_POST['Project']['reason_revise'];

            
            $model->save();

            return $this->redirect(['/project/revise','project' => (string)$project]);



        } else {

            return $this->renderAjax('reason', [
                'model' => $model,
            ]);

        }

    }

    public function actionRevise($project)
    {   
        $asiaebuy = Asiaebuy::find()->one();
        $models = Project::find()
        ->where(['_id'=>$project])
        ->one();


        return $this->render('revise', [
            'models' => $models,
            'asiaebuy' => $asiaebuy,
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
                                'data.choosed' => 'on'
                            ],
                            [
                                'status' => 'Completed'
                            ],
                 


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






    public function actionDetail($id)
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

 

        return $this->render('detail', [
            'models' => $models,
            'status' => $status,
            'newProject_id' => $newProject_id
        ]);
    }


    public function actionStatus($project)
    {

        $model = Status::find()
        ->where(['project' => (string)$project])
        ->one();




        if ($model->load(Yii::$app->request->post()) ) {


            $collection = Yii::$app->mongodb->getCollection('status');


            if ($_POST['Status']['in_time_status'] == 'Processing') {


                    $arrUpdate = [
                            '$push' => [
                                'detail' => [
                                    
                                        'status' => empty($_POST['Status']['detail']['status']) ? '': $_POST['Status']['detail']['status'], 
                                        'date' => date('Y-m-d'),
                                        'date_time' => date('Y-m-d H:i:s'),


                                ],

                            ]
                        
                    ];




            } elseif ($_POST['Status']['in_time_status'] == 'Shipped') {

                if (empty($model['item'][1])) {


                        $arrUpdate = [
                                '$set' => [
                                    'in_time_status' => empty($_POST['Status']['in_time_status']) ? '': $_POST['Status']['in_time_status'], 

                                ],
                                '$push' => [
                                    'item' => [
                                        
                                            'status' => empty($_POST['Status']['in_time_status']) ? '': $_POST['Status']['in_time_status'], 
                                            'date' => date('Y-m-d'),
                                            'date_time' => date('Y-m-d H:i:s'),


                                    ],
                                    'detail' => [
                                        
                                            'status' => empty($_POST['Status']['detail']['status']) ? '': $_POST['Status']['detail']['status'], 
                                            'date' => date('Y-m-d'),
                                            'date_time' => date('Y-m-d H:i:s'),
                                            'extra' => empty($_POST['Status']['extra']) ? '': $_POST['Status']['extra'], 

                                    ],

                                ]
                            
                        ];


      
                } else {

                            $arrUpdate = [
                                    '$push' => [

                                        'detail' => [
                                            
                                                'status' => empty($_POST['Status']['detail']['status']) ? '': $_POST['Status']['detail']['status'], 
                                                'date' => date('Y-m-d'),
                                                'date_time' => date('Y-m-d H:i:s'),
                                                'extra' => empty($_POST['Status']['extra']) ? '': $_POST['Status']['extra'], 

                                        ],

                                    ]
                                
                            ];



                }


            } elseif ($_POST['Status']['in_time_status'] == 'Delivered') {

                if (empty($model['item'][2])) {

                        $arrUpdate = [
                                '$set' => [
                                    'in_time_status' => empty($_POST['Status']['in_time_status']) ? '': $_POST['Status']['in_time_status'], 

                                ],
                                '$push' => [
                                    'item' => [
                                        
                                            'status' => empty($_POST['Status']['in_time_status']) ? '': $_POST['Status']['in_time_status'], 
                                            'date' => date('Y-m-d'),
                                            'date_time' => date('Y-m-d H:i:s'),


                                    ],
                                    'detail' => [
                                        
                                            'status' => empty($_POST['Status']['detail']['status']) ? '': $_POST['Status']['detail']['status'], 
                                            'date' => date('Y-m-d'),
                                            'date_time' => date('Y-m-d H:i:s'),


                                    ],

                                ]
                            
                        ];

                

      
                } else {

                        $arrUpdate = [
                                '$push' => [

                                    'detail' => [
                                        
                                            'status' => empty($_POST['Status']['detail']['status']) ? '': $_POST['Status']['detail']['status'], 
                                            'date' => date('Y-m-d'),
                                            'date_time' => date('Y-m-d H:i:s'),

                                    ],

                                ]
                            
                        ];


                        


                }


            $newProject_id = new \MongoDB\BSON\ObjectID($project);

            $nty = Notification::find()->where(
                [
                    'status' => 'In Progress Order',
                    'project' => $newProject_id

                ])->one();

            $nty->status = 'Order Delivered';

            $nty->save();




            } elseif ($_POST['Status']['in_time_status'] == 'Cancel') {


                if (empty($model['item'][3])) {


                        $arrUpdate = [
                                '$set' => [
                                    'in_time_status' => empty($_POST['Status']['in_time_status']) ? '': $_POST['Status']['in_time_status'], 

                                ],
                                '$push' => [
                                    'item' => [
                                        
                                            'status' => empty($_POST['Status']['in_time_status']) ? '': $_POST['Status']['in_time_status'], 
                                            'date' => date('Y-m-d'),
                                            'date_time' => date('Y-m-d H:i:s'),


                                    ],
                                    'detail' => [
                                        
                                            'status' => empty($_POST['Status']['detail']['status']) ? '': $_POST['Status']['detail']['status'], 
                                            'date' => date('Y-m-d'),
                                            'date_time' => date('Y-m-d H:i:s'),
                                            'refund' => empty($_POST['Status']['refund']) ? '': $_POST['Status']['refund'], 
                                  
 
                                    ],

                                ]
                            
                        ];

                    
      
                } else {

                        $arrUpdate = [
                                '$push' => [

                                    'detail' => [
                                        
                                            'status' => empty($_POST['Status']['detail']['status']) ? '': $_POST['Status']['detail']['status'], 
                                            'date' => date('Y-m-d'),
                                            'date_time' => date('Y-m-d H:i:s'),
                                            'refund' => empty($_POST['Status']['refund']) ? '': $_POST['Status']['refund'], 

                                    ],

                                ]
                            
                        ];


                        


                }

            $newProject_id = new \MongoDB\BSON\ObjectID($project);

            $nty = Notification::find()->where(
                [
                    'status' => 'In Progress Order',
                    'project' => $newProject_id

                ])->one();

            $nty->status = 'Order Cancelled';

            $nty->save();




                
            } 


            $collection->update(['project' => (string)$project],$arrUpdate);

            return $this->redirect(['/project/detail','id' => (string)$project]);


        } else {
            return $this->renderAjax('status', [
                'model' => $model,
            ]);
        }
    }

    public function actionStatd($status)
    {
        $countPosts = LookupDetail::find()
        ->where(['status' => $status])
        ->count();

        $posts = LookupDetail::find()
        ->where(['status' => $status])
        ->all();

        if($countPosts>0){
            echo "<option value=''>-Chooese Detail-</option>";
            foreach($posts as $post){
                echo "<option value='".$post->details."'>".$post->details."</option>";
            }
        } else {
                echo "<option></option>";
        }

    }

    public function actionNotify($id,$module)
    {

        $newProject_id = new \MongoDB\BSON\ObjectID($id);

        $models = Notification::find()
        ->where(['_id' => $newProject_id])
        ->one();


        if ($module == 'rfq') {

            $models->read_unread = 0;
            $models->status = 'In Progress Quotation';

            $models->save();

            return $this->redirect(['/project/quote','id' => (string)$models->project]);

        } elseif ($module == 'order') {

            $models->read_unread = 0;
            $models->status = 'In Progress Order';

            $models->save();

            return $this->redirect(['/project/detail','id' => (string)$models->project]);
            
        }

    

    }




}