<?php

namespace frontend\modules\fisher\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\ItemCart;
use common\models\Project;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use common\models\LoginFormFisher;
use common\models\User;
use common\models\Notification;
use common\models\Email;
use common\models\Message;
use yii\web\Session;
use yii\helpers\Url;
use frontend\models\OcCustomer;
use frontend\models\OcAddress;
use yii\db\Query;
/**
 * Default controller for the `fisher` module
 */
class DefaultController extends Controller
{

    public $layout = '@frontend/views/layouts/module.php';




    public function actionCurl()
    {

        $url = $_POST['url'];

       echo "<iframe sandbox='allow-same-origin allow-scripts allow-popups allow-forms' src='".$url."'  style='overflow: hidden;height:600px;width:100%;'></iframe>";



    }




    public function actionIndex()
    {
 
    	$model = new ItemCart();

        Yii::$app->session->open();
        $session_id = Yii::$app->session->id;

        if (empty(Yii::$app->user->identity->id)) {

            $items = ItemCart::find()->where(['session_id' => $session_id])->all();

        } else {
            
            $items = ItemCart::find()->where(['customer_id' => Yii::$app->user->identity->id])->all();

            $user = User::find()->where(['_id' => Yii::$app->user->identity->id])->one();
            $progressProject = Project::find()->where(
                [
                    'status' => 'Progress',
                    'email' => $user->email

                ]
            )->one();

        }

        if($model->load(Yii::$app->request->post()) && $model->validate()){

        	$model->date_create = date('Y-m-d');
        	$model->date_time_create = date('Y-m-d H:i:s');
            if (Yii::$app->user->isGuest == 'Guest') {
                $model->customer_id = 'Guest';
                $model->session_id = Yii::$app->session->id;

            } else {

                $model->customer_id = Yii::$app->user->identity->id;
                $model->session_id = Yii::$app->session->id;
            }

        	$model->save();

            Yii::$app->session->setFlash('success_added', 'Item Added');
            return $this->redirect(['default/index']);


        } else {

            return $this->render('index', [
                'model' => $model,
                'items' => $items,
                'session_id' => $session_id,
                'progressProject' => $progressProject
            ]);
        }

    }


    public function actionGuest()
    {

        $opencart = Url::to('@opencart');


        $url = $opencart.'yii/signup&param='.base64_encode(Yii::$app->session->id);

        return $this->render('guest', [
            'url' => $url,

        ]);



        //header("Location: ".$url."");
    }

    public function actionProject()
    {

        $user = User::find()->where(['_id' => Yii::$app->user->identity->id])->one();

        $customer_id = base64_decode($user->customer_id);


        $query = new Query;
        $query  ->select(['*'])  
                ->from('oc_customer')
                ->where(
                    [
                        'customer_id'=>$customer_id,
                  
                    ])
                ->one(); 
                
        $command = $query->createCommand();
        $customer = $command->queryAll();


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
        $address = $command2->queryAll(); // depend on default address


        $project = new Project();

        $project->email = $customer[0]['email'];
        $project->name = $customer[0]['lastname'].' '.$customer[0]['firstname'];
        $project->company_name = empty($address[0]['company']) ? '' : $address[0]['company'];
        $project->address = empty($address[0]['address_1']) ? '' : $address[0]['address_1'].' '.$address[0]['address_2'];
        $project->postcode = empty($address[0]['postcode']) ? '' : $address[0]['postcode'];
        $project->city = empty($address[0]['city']) ? '' : $address[0]['city'];
        $project->province = $address[0]['zone_name'];
        $project->country = $address[0]['country_name'];
        $project->contact_no = $customer[0]['telephone'];
        $project->status = 'Progress';
        $project->save();

        return $this->redirect(['default/continue','project'=> (string)$project->_id]);
    }


    public function actionCart($param)
    {
        $model = Project::find()->where(['email' => base64_decode($param),'status'=>'Progress'])->one();

        if (empty($model)) {

            return $this->redirect(['default/empty']);

        } else {

            return $this->redirect(['default/continue','project'=> (string)$model->_id]);

        }

    }

    public function actionEmpty()
    {

        return $this->render('empty');

    }





    public function actionContinue($project)
    {

        $items = ItemCart::find()->where(['customer_id' => Yii::$app->user->identity->id])->all();
        $model = Project::find()->where(['_id' => $project])->one();
        $user = User::find()->where(['_id' => Yii::$app->user->identity->id])->one();


        $customer_id = base64_decode($user->customer_id);

        $query = new Query;
        $query  ->select(['*','oc_country.name AS country_name','oc_zone.name AS zone_name'])  
                ->from('oc_address')
                ->leftJoin('oc_country','oc_address.country_id = oc_country.country_id')
                ->leftJoin('oc_zone','oc_address.zone_id = oc_zone.zone_id')
                ->where(
                    [
                        'oc_address.customer_id'=> base64_decode($user->customer_id)
                  
                    ])
                ->one(); 
                
        $command = $query->createCommand();
        $address = $command->queryAll();




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



            foreach ($items as $key => $value) {
                $dataTemp[] = [

                    'catalog_no' => $value['catalog_no'],
                    'quantity' => $value['quantity'],
                    'date_create' => $value['date_create'],
                    'date_time_create' => $value['date_time_create'],
                    'customer_id' => $value['customer_id'],
                    'session_id' => $value['session_id'],
                ];
            }

            $data = serialize($dataTemp);


        $check = Project::find()
        ->orderBy([
           'myRFQ'=>SORT_DESC,
        ])
        ->limit(1)
        ->all();

        foreach ($check as $key => $value) {
            $temp = $value['myRFQ'];
        }


        $runningNo = $temp;




        if ($model->load(Yii::$app->request->post()) ) {


            $model->data = unserialize($data);
            $model->date_create = date('Y-m-d');
            $model->date_time_create = date('Y-m-d H:i:s');
            $model->belong_to = Yii::$app->user->identity->id;
            
            $model->status = $_POST['Project']['status'];

            if (empty($_POST['Project']['diff_add_info'])) {

                if ($address_check[0]['country_id'] == 129) {

                    $model->currency = 'MYR';


                } elseif ($address_check[0]['country_id'] == 209 || $address_check[0]['country_id'] == 100 || $address_check[0]['country_id'] == 168 || $address_check[0]['country_id'] == 230 || $address_check[0]['country_id'] == 188 || $address_check[0]['country_id'] == 36 || $address_check[0]['country_id'] == 116 || $address_check[0]['country_id'] == 32) {

                    $model->currency = 'USD';
  
                } else {

                    $model->currency = 'USD';

                }

                $model->diff_add_info = 'No';

            } else {

                if ($address_check[0]['country_id'] == 129) {

                    $model->currency = 'MYR';


                } elseif ($address_check[0]['country_id'] == 209 || $address_check[0]['country_id'] == 100 || $address_check[0]['country_id'] == 168 || $address_check[0]['country_id'] == 230 || $address_check[0]['country_id'] == 188 || $address_check[0]['country_id'] == 36 || $address_check[0]['country_id'] == 116 || $address_check[0]['country_id'] == 32) {

                    $model->currency = 'USD';
  
                } else {

                    $model->currency = 'USD';

                }



                $query = new Query;
                $query  ->select(['*','oc_country.name AS country_name','oc_zone.name AS zone_name'])  
                        ->from('oc_address')
                        ->leftJoin('oc_country','oc_address.country_id = oc_country.country_id')
                        ->leftJoin('oc_zone','oc_address.zone_id = oc_zone.zone_id')
                        ->where(
                            [
                                'oc_address.customer_id'=> base64_decode($user->customer_id),
                                'oc_address.address_id' =>$_POST['Project']['diff_add_info']
                          
                            ])
                        ->one(); 
                        
                $command = $query->createCommand();
                $address_temp = $command->queryAll();

                $model->diff_add_info = 'Yes';
                $model->diff_company = empty($address_temp[0]['company']) ? '' : $address_temp[0]['company'];
                $model->diff_name = empty($address_temp[0]['firstname']) ? '' : $address_temp[0]['firstname'].' '.$address_temp[0]['lastname'];
                $model->diff_address = empty($address_temp[0]['address_1']) ? '' : $address_temp[0]['address_1'].' '.$address_temp[0]['address_2'];
                $model->diff_postcode = empty($address_temp[0]['postcode']) ? '' : $address_temp[0]['postcode'];
                $model->diff_city = empty($address_temp[0]['city']) ? '' : $address_temp[0]['city'];
                $model->diff_province = empty($address_temp[0]['zone_name']) ? '' : $address_temp[0]['zone_name'];
                $model->diff_country = empty($address_temp[0]['country_name']) ? '' : $address_temp[0]['country_name'];



            }


            $no = 1000;
            if (empty($runningNo)) {
               
                $model->myRFQ = $no;

            } else {

                $model->myRFQ = $runningNo + 1;

            }

            $model->save();
            
            ItemCart::deleteAll(['customer_id' => Yii::$app->user->identity->id]);

            $notification = new Notification();
            $notification->date = date('Y-m-d');
            $notification->date_time = date('Y-m-d H:i:s');
            $notification->message = $user->email.' Request RFQ';
            $notification->from_who = Yii::$app->user->identity->id;
            $notification->to_who = 'admin';
            $notification->status = '';
            $notification->read_unread = 1;
            $notification->project = $model->_id;
            $notification->path = '/project/notify';
            $notification->module = 'rfq';

            $notification->save();
    
            $admin = Url::to('@admin');

            $from =  Yii::$app->params['supportEmail'];
            $to = Yii::$app->params['adminEmail'];

            $subject = $user->email.' Ask For Quotation For Project : '.$model->myRFQ;

            $text = 'You Have 1 RFQ From : '.$user->email.' <br><br> '.$admin.'/project/notify?id='.(string)$notification->_id.'&module=rfq';


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


            Yii::$app->session->setFlash('rqf_submit', 'Your RFQ Successfully Submitted');

            return $this->redirect(['default/index']); 



 

     
        } else {


            return $this->render('continue', [
                'model' => $model,
                'items' => $items,
                'address' => $address,
       



            ]);


        }

    }

    public function actionDelete($id)
    {

        ItemCart::deleteAll(['_id' => $id]);

        return $this->redirect(['default/index']);

    }

    public function actionMessage($id)
    {

        $models = Message::find()
        ->where(['_id' => (string)$id])
        ->one();

        $models->read_unread = 1;

        $models->save();

        return $this->redirect(['/fisher/project/message','project' => (string)$models->project]);

    }



}
