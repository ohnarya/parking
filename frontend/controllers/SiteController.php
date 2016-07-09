<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use common\models\LoginForm;
use frontend\models\login\PasswordResetRequestForm;
use frontend\models\login\ResetPasswordForm;
use frontend\models\login\SignupForm;
use frontend\models\login\ContactForm;
use frontend\models\Users;
use frontend\models\parking\ParkingLot;

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
        //     'access' => [
        //         'class' => AccessControl::className(),
        //         'only' => ['logout', 'signup'],
        //         'rules' => [
        //             [
        //                 'actions' => ['signup'],
        //                 'allow' => true,
        //                 'roles' => ['?'],
        //             ],
        //             [
        //                 'actions' => ['logout'],
        //                 'allow' => true,
        //                 'roles' => ['@'],
        //             ],
        //         ],
        //     ],
        //     'verbs' => [
        //         'class' => VerbFilter::className(),
        //         'actions' => [
        //             'logout' => ['post'],
        //         ],
        //     ],
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
 
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionSetting()
    {
        $model = Users::findOne(Yii::$app->user->identity->id);
        $model->permit = Json::decode($model->permit);
        $parkinglot = ParkingLot::find()->select('permit')->where(['active'=>true])->asArray()->all();
        $parkinglot = ArrayHelper::map($parkinglot, 'permit', 'permit');
        return $this->render('setting', [
            'model' => $model,
            'parkinglot'=>$parkinglot
        ]);        
    }
    public function actionSettingsave()
    { 
        $model = Users::findOne(Yii::$app->user->identity->id);
        if($model->load(Yii::$app->request->post())){
            $model->permit = Json::encode($model->permit);
            if($model->save()){
                return $this->redirect(['parkinglot/index']);
            }else{
                print_r($model->getErrors());
            }
        }    
        
    }
    public function actionLogin()
    {
   
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goHome();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->render('index');

                }
            }
        }
        $parkinglot = ParkingLot::find()->select('permit')->where(['active'=>true])->asArray()->all();
        $parkinglot = ArrayHelper::map($parkinglot, 'permit', 'permit');
        
        return $this->render('signup', [
            'model' => $model,
            'parkinglot' => $parkinglot
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
