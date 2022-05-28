<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Auth;
use app\models\User;
use app\models\Offer;
use app\models\Category;


class SiteController extends Controller
{
    
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
        ->andWhere(['>', 'number_comments', 0])
        ->orderBy(['number_comments' => SORT_DESC])
        ->limit(8)
        ->all();
        
        $categories = Category::find()
        ->with('offers')
        ->all();
        
        return $this->render('index', [
            'offers' => $offers,
            'populares' => $populares,
            'categories' => $categories
        ]);
    }


    public function actionLogin()
    {
        return $this->redirect('/register'); 
    }

}
