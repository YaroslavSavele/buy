<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Category;
use app\models\Offer;
use yii\web\UploadedFile;

class OffersController extends Controller 
{
   public function actionAdd() 
   {
      $model = new Offer;

      if (Yii::$app->request->isPost) {
         $model->load(\Yii::$app->request->post());
         
         $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
         
         if ($model->validate()) {
         //echo AppController::debug($model);
         //die;
            $model->upload();
            $model->user_id = Yii::$app->user->getId();
            $model->save(false);
            return $this->goHome();
         }
      }
      
      $categories = Category::find()->all();

      return $this->render('add', [
         'model' => $model,
         'categories' => $categories,
      ]);
   }

   public function actionMy()
   {
       $query = Offer::find();
       $query->andWhere(['user_id' => Yii::$app->user->id]);
       $query->orderBy(['created_at' => SORT_DESC]);
       $tickets = $query->all();
       return $this->render('my', ['tickets' => $tickets]);
   }
}