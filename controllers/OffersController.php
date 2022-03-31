<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Category;
use yii\web\UploadedFile;

class OffersController extends Controller 
{
   public function actionAdd() 
   {
      return $this->render('add');
   }
}