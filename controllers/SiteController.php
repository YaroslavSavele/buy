<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Auth;
use app\models\User;
use app\controllers\AppController;
use yii\db\Expression;
use yii\web\NotFoundHttpException;
use app\models\Offer;
use app\models\Comment;
use yii\db\Query;

use yii\authclient\clients\VKontakte;

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
               $user->password = $password;
               $user->password_repeat = $password;
               $user->avatar = $attributes['photo'];
            
            if ($user->save()) {
         ;
               $auth = new Auth();
               $auth->user_id = $user->id;
               $auth->source = $client->getId();
               $auth->sourse_id = $attributes['id'];
               if ($auth->save()) {
                  Yii::$app->user->login($user);
                  $this->redirect('/');
               }
            }
         }
      }
   }
//echo AppController::debug($auth);
//         die;

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $query = Offer::find();
        $query->orderBy(['created_at' => SORT_DESC])->limit(8);
        $offers = $query->all();

        $populares = Offer::find()
        ->joinWith('comments', 'comments.offer_id = offers.id')
        //->orderBy(['count(comments)' => SORT_ASC])
        ->limit(8)
        ->all();
        // TODO добавить в таблиццу offers колонку кол-во комментариев чтобы решить проблему показа популярных объвлений
        // TODO $post->updateCounters(['view_count' => 1]);
        echo AppController::debug($populares);
        die;
        return $this->render('index', [
            'offers' => $offers,
            'populares' => $populares
        ]);
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
