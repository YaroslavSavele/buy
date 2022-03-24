<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\User;
use yii\web\UploadedFile;

class RegisterController extends Controller 
{
   public function actionIndex() 
   {
      $model = new User;
      if (Yii::$app->request->isPost) {
         $model->load(\Yii::$app->request->post());
         
         $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
         //   echo AppController::debug($model->imageFile);
         //die;
         if ($model->validate()) {
         
            $model->upload();
            $model->password = Yii::$app->security->generatePasswordHash($model->password);
            $model->save(false);
         }
      }
      return $this->render('index', ['model' => $model]);
   }
}
