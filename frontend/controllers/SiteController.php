<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use frontend\models\ItemCart;
use yii\base\Model;
use common\models\User;
use yii\helpers\Url;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout','exit','terminate'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'exit' => ['post'],
                ],
            ],
        ];
    }


    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }


    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionAsiaebuy()
    {

        $url = Url::to('@oc');

        header("Location: ".$url."");
    }

    // login embed open cart
    public function actionLogin($email,$password,$param4)
    {
        $this->layout = 'module';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $mail = base64_decode($email);
        $pass = base64_decode($password);

        $check = User::find()->where( [ 'email' => $mail ] )->exists(); 
        
        if(empty($check)) {
            
            $user = new User();
            $user->username = $mail;
            $user->email = $mail;
            $user->customer_id = $customer;
            $user->setPassword($pass);
            $user->generateAuthKey();
            $user->save();
            
            $model = new LoginForm();
            $model->username = $mail;
            $model->password = $pass;

            $model->login();
            
            
            
        } else {
            
            $model = new LoginForm();
            $model->username = $mail;
            $model->password = $pass;

            $model->login();
            
        }

        $user = User::find()->where(['_id' => Yii::$app->user->identity->id])->one();

        $items = ItemCart::find()->where(['session_id' => base64_decode($param4)])->all();

        foreach ($items as $item) {
            $item->customer_id = $user->_id;
            $item->update(false); // skipping validation as no user input is involved
        }

            $asiax = Url::to('@asiax');

            $url = $asiax.'/fisher';

            echo "<script>window.top.location.href = \"$url\";</script>";



    }


    public function actionRegister()
    {
        $this->layout = 'module';

        $opencart = Url::to('@opencart');

        $url = $opencart.'yii/register';

        return $this->render('register', [
            'url' => $url,

        ]);


    }

    public function actionDone($param1,$param2,$param3)
    {
        $this->layout = 'module';
        $mail = base64_decode($param1);
        $pass = base64_decode($param2);

 
        $user = new User();
        $user->username = $mail;
        $user->email = $mail;
        $user->customer_id = $param3;
        $user->setPassword($pass);
        $user->generateAuthKey();
        $user->save();

        if (Yii::$app->getUser()->login($user)) {

            $asiax = Url::to('@asiax');

            $url = $asiax.'/fisher';

            echo "<script>window.top.location.href = \"$url\";</script>";


      
        }

    }

    public function actionLogonRedirect($param)
    {
        $this->layout = 'module';
        $items = ItemCart::find()->where(['session_id' => base64_decode($param)])->all();

        $opencart = Url::to('@opencart');
        if (empty($items)) {

            $url = $opencart.'yii/logon&param=empty';

        } else {

            $url = $opencart.'yii/logon&param='.$param;
        }

        return $this->render('logon-redirect', [
            'url' => $url,

        ]);

    }


    public function actionLogon($email,$password,$param)
    {


        $this->layout = 'module';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $mail = base64_decode($email);
        $pass = base64_decode($password);

        $model = new LoginForm();

        $model->username = $mail;
        $model->password = $pass;

        $model->login();

        if ($param == 'empty') {
           
        } else {

            $user = User::find()->where(['_id' => Yii::$app->user->identity->id])->one();
            $items = ItemCart::find()->where(['session_id' => base64_decode($param)])->all();

            foreach ($items as $item) {
                $item->customer_id = $user->_id;
                $item->update(false); // skipping validation as no user input is involved
            }


        }


        $asiax = Url::to('@asiax');

        $url = $asiax.'/fisher';


        echo "<script>window.top.location.href = \"$url\";</script>";

    }




    // if user click link asia-x
    public function actionAccess($email,$password,$customer_id)
    {
		
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
		$this->layout = 'module';
	
        $mail = base64_decode($email);
        $pass = base64_decode($password);
		$customer = $customer_id;
		
		$check = User::find()->where( [ 'email' => $mail ] )->exists(); 
		
		if(empty($check)) {
			
			$user = new User();
			$user->username = $mail;
			$user->email = $mail;
			$user->customer_id = $customer;
			$user->setPassword($pass);
			$user->generateAuthKey();
			$user->save();
			
			$model = new LoginForm();
			$model->username = $mail;
			$model->password = $pass;

			$model->login();
			
			
	
			
		} else {
			
			$model = new LoginForm();
			$model->username = $mail;
			$model->password = $pass;

			$model->login();
			
		}
		
        return $this->redirect(['/fisher']);
    }

    // this logout from yii2
    public function actionExit()
    {
        $this->layout = 'module';
        Yii::$app->user->logout();

        $opencart = Url::to('@opencart');

        $url = $opencart.'yii/exit';

        header("Location: ".$url."");
    }


    //  this logout from opencart
    public function actionLogout()
    {
        $this->layout = 'module';
        Yii::$app->user->logout();

        $opencart = Url::to('@opencart');

        $url = $opencart.'account/logout';

        header("Location: ".$url."");
    }


    // param1 = email , param2 = password , param3 = customerid
    public function actionSignup($param1,$param2,$param3,$param4)
    {
        $this->layout = 'module';
        $mail = base64_decode($param1);
        $pass = base64_decode($param2);

 
        $user = new User();
        $user->username = $mail;
        $user->email = $mail;
        $user->customer_id = $param3;
        $user->setPassword($pass);
        $user->generateAuthKey();
        $user->save();

       $items = ItemCart::find()->where(['session_id' => base64_decode($param4)])->all();

        foreach ($items as $item) {
            $item->customer_id = $user->_id;
            $item->update(false); // skipping validation as no user input is involved
        }


        if (Yii::$app->getUser()->login($user)) {

            $asiax = Url::to('@asiax');

            $url = $asiax.'/fisher';

            echo "<script>window.top.location.href = \"$url\";</script>";


      
        }

    }


    public function actionAccount()
    {
        $this->layout = 'module';
        $opencart = Url::to('@opencart');

        $url = $opencart.'yii/account';


        return $this->render('account', [
            'url' => $url,

        ]);
    }

    public function actionInfoChange($param1,$param2)
    {
        $this->layout = 'module';
        $user = User::find()->where(['customer_id' => $param1])->one();

        $user->email = $param2;
        $user->username = $param2;
        $user->save();

        $asiax = Url::to('@asiax');

        $url = $asiax;

        echo "<script>window.top.location.href = \"$url\";</script>";


    }

    public function actionInfoPassword($param1,$param2)
    {   
        $this->layout = 'module';

        $user = User::find()->where(['customer_id' => $param1])->one();

        $user->password_hash = Yii::$app->security->generatePasswordHash($param2);


        $user->save();

        $asiax = Url::to('@asiax');

        $url = $asiax;

        echo "<script>window.top.location.href = \"$url\";</script>";


    }

    public function actionAbout()
    {
            $this->layout = 'module';

        $opencart = Url::to('@opencart');

        $url = $opencart.'yii/information&information_id=4';

        return $this->render('about', [
            'url' => $url,

        ]);
    }

    public function actionPolicy()
    {
        $this->layout = 'module';

        $opencart = Url::to('@opencart');

        $url = $opencart.'yii/information&information_id=3';

        return $this->render('policy', [
            'url' => $url,

        ]);
    }

    public function actionTerm()
    {
        $this->layout = 'module';
        $opencart = Url::to('@opencart');

        $url = $opencart.'yii/information&information_id=5';

        return $this->render('term', [
            'url' => $url,

        ]);
    }


    public function actionContact()
    {

        $this->layout = 'module';
        $opencart = Url::to('@opencart');

        $url = $opencart.'yii/contact';

        return $this->render('contact', [
            'url' => $url,

        ]);
    }




}
