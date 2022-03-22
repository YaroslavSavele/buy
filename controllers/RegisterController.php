<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\User;

class RegisterController extends Controller 
{
   public function actionIndex() 
   {
      $model = new User;

      return $this->render('index', ['model' => $model]);
   }
}
