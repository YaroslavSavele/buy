<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
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

    /**
     * {@inheritdoc}
     */
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
            'auth' => [
               'class' => 'yii\authclient\AuthAction',
               'successCallback' => [$this, 'onAuthSuccess'],
           ],
        ];
    }

    public function onAuthSuccess($client) 
    {
      $attributes = $client->getUserAttributes();
          echo AppController::debug($attributes);
         die;
       /* @var $auth Auth */
       $auth = Auth::find()->where([
         'source' => $client->getId(),
         'sourse_id' => $attributes['id'],
     ])->one();

     if (Yii::$app->user->isGuest) {
         if ($auth) { // авторизация
            $user = $auth->user;
            Yii::$app->user->login($user);
         } else {
            $password = Yii::$app->security->generateRandomString(6);
            $user = new User();
               if (isset($attributes['first_name'], $attributes['last_name'])) {
               $user->name = implode(' ', array($attributes['first_name'], $attributes['last_name']));
               }
               if (isset($attributes['email'])) {
                  $user->email = $attributes['email'];
               } else {
                  $user->email = $attributes['id'] . '@buy.com';
               }
               $user->user_password = $password;
               $user->password_repeat = $password;
               $user->city_id = $attributes['city']['id'];
            
            if ($user->save()) {
               $auth = new Auth([
                   'iser_id' => $user->id,
                   'source' => $client->getId(),
                   'sourse_id' => $attributes['id'],
               ]);

               if ($auth->save()) {
                  Yii::$app->user->login($user);
                  $this->redirect('/');
               }
            }
         }
      }
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

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
