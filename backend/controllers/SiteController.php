<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\LookupLeadTime;
use common\models\LookupValidity;
use common\models\Paypal;
use common\models\Project;
use yii\data\ActiveDataProvider;
use common\models\Email;
use common\models\Message;
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
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index','setting','paypal','email','message'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }


    public function actionPaypal()
    {
        $project = Project::find()->where(['status'=>'Completed'])->all();
        return $this->render('paypal',[
            'project' => $project
        ]);
    }

    public function actionEmail()
    {
        $project = Project::find()->orderBy(['_id' => SORT_DESC])->all();



        return $this->render('email',[
            'project' => $project
        ]);
    }


    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $this->layout = 'login';
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }
    public function actionSetting()
    {
        $validity = LookupValidity::find()->all();

        $lead = LookupLeadTime::find()->all();

        return $this->render('setting', [
            'validity' => $validity,
            'lead' => $lead,
        ]);


    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionMessage($id)
    {

        $models = Message::find()
        ->where(['_id' => (string)$id])
        ->one();

        $models->read_unread = 1;

        $models->save();

        return $this->redirect(['/project/message','project' => (string)$models->project]);

    }



}
