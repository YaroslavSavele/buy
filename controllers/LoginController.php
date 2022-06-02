<?php
namespace app\controllers;

use app\models\LoginForm;
use yii\web\Controller;

class LoginController extends Controller
{
    public function actionIndex()
    {
        $loginForm = new LoginForm();
        if (\Yii::$app->request->getIsPost()) {
            $loginForm->load(\Yii::$app->request->post());
            if ($loginForm->validate()) {
                $user = $loginForm->getUser();
                \Yii::$app->user->login($user);
                return $this->goHome();
            }
        }
        return $this->render('index', ['model' => $loginForm]);
    }

    public function actionLogout()
    {
        \Yii::$app->user->logout();
        return $this->goHome();
    }
}