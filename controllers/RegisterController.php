<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class RegisterController extends Controller 
{
   public function actionIndex() 
   {
      return $this->render('register');
   }
}
