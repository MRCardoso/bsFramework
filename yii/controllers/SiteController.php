<?php

namespace app\controllers;

use app\models\CorporateRegister;
use app\models\Login;
use app\models\PasswordForm;
use app\models\PasswordResets;
use app\models\Request;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\NotFoundHttpException;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
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
        if( Yii::$app->user->isGuest )
        {
            return $this->render('info');
        }
        else
        {
            $searchModel = new Request();
            $dataProvider = $searchModel->findRecent(Yii::$app->request->get());

            return $this->render('index', compact('searchModel','dataProvider'));
        }
    }

    public function actionSignin()
    {
        if (!\Yii::$app->user->isGuest)
            return $this->goHome();

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login())
            return $this->goBack();

        return $this->render('signin', compact('model'));
    }
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    public function actionPassword()
    {
        throw new NotFoundHttpException(t('The requested page does not exist.'));
        $model = new PasswordForm();
        $model->setScenario('checkMail');

        if( $model->load(Yii::$app->request->post()) && $model->sendPassword() )
            return $this->goBack();

        return $this->render('password/email', compact('model'));
    }
    public function actionPassword_reset($token)
    {
        throw new NotFoundHttpException(t('The requested page does not exist.'));
        $passwordResets = PasswordResets::findToken($token);
        if( $passwordResets )
        {
            $model = new PasswordForm();
            $model->setScenario('changePassword');

            if( $model->load(Yii::$app->request->post()) && $model->resetPassword($passwordResets) )
                return $this->goBack();

            return $this->render('password/reset', compact('model'));
        }
        else
            throw new NotFoundHttpException(t('The requested page does not exist.'));
    }
}
