<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Category;
use app\models\Offer;
use app\models\Comment;
use app\models\Chat;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;

class OffersController extends Controller 
{
   public function actionAdd() 
   {
      $model = new Offer;

      if (Yii::$app->request->isPost) {
         $model->load(\Yii::$app->request->post());
         
         $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
         
         if ($model->validate()) {
         
            $model->upload();
            $model->user_id = Yii::$app->user->getId();
            $model->save(false);
            return $this->redirect('/offers/my');
         }
      }
      
      $categories = Category::find()->all();

      return $this->render('add', [
         'model' => $model,
         'categories' => $categories,
      ]);
   }
    
    public function actionEdit($id)
    {
        $model = Offer::findOne($id);
        if(!$model) {
            throw new NotFoundHttpException("Объявление не найдено!");
        }

        $categories = Category::find()->all();

        if (Yii::$app->request->isPost) {
         $model->load(\Yii::$app->request->post());
         
         $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
         
         if ($model->validate()) {
            $model->upload();
            $model->imageFile = '';
            if ($model->update()) {
            return $this->redirect('/offers/my');
        }
         }
      }
        
      return $this->render('edit', [
            'model'=>$model,
            'categories' => $categories,
        ]);
    }
    
    public function actionDelete($id)
    {
        $offer = Offer::findOne($id);
        if(!$offer) {
            throw new NotFoundHttpException("Объявление не найдено!");
        }
        $offer->delete();
        return $this->redirect('/offers/my');
    }

    public function actionMy()
    {
        $query = Offer::find();
        $query->andWhere(['user_id' => Yii::$app->user->id]);
        $query->orderBy(['created_at' => SORT_DESC]);
        $offers = $query->all();
        return $this->render('my', ['offers' => $offers]);
    }

    public function actionView($id)
    {
        $offer = Offer::findOne($id);
        if(!$offer) {
            throw new NotFoundHttpException("Объявление не найдено!");
        }
        $autor_id = $offer->user_id;
        $idCategory = $offer->category_id;
        $offersCategory = Offer::find()
        ->where(['category_id' => $idCategory])
        ->all();

        $comment = new Comment();
        if(Yii::$app->request->isPost) {
            $comment->load(Yii::$app->request->post());
            if ($comment->validate()) {
                $comment->offer_id = $id;
                $comment->user_id = Yii::$app->user->id;
                if ($comment->save()) {
                    $offer->updateCounters(['number_comments' => 1]);
                }
                
                return $this->redirect('/offers/view/:'.$id);
            }
        }

        $query = Comment::find();
        $query->andWhere(['offer_id' => $id]);
        $query->orderBy(['created_at' => SORT_DESC]);
        $reviews = $query->all();

        $chat = new Chat();
        $listMessages = $chat->get($id);
        //echo AppController::debug($listMessages);die;
        //https://firebase.google.com/docs/database/rest/structure-data
        if(Yii::$app->request->isPost) {
            $chat->load(Yii::$app->request->post());
            if ($chat->validate()) {
                
                $chat->write([
                    'user_id' => Yii::$app->user->id,
                    'text' => $chat->text,
                    'created_at' => date('H:i'),
                    'autor_id' => $autor_id,
                ], $id); 
                
            }
        }
        

        return $this->render('view', [
            'offer' => $offer,
            'comment' => $comment,
            'reviews' => $reviews,
            'offersCategory' => $offersCategory,
            'chat' => $chat,
            'listMessages' => $listMessages,
        ]);
    }

    public function actionComments() 
    {
        $id = Yii::$app->user->id;
        $offers = Offer::find()
        ->where(['user_id' => $id])
        ->andWhere(['>', 'number_comments', 0])
        ->with('comments')
        ->all();
        
        //$offers->where(['=', 'type', 2])->all();
        
        //echo AppController::debug($offers);
        //die;

        return $this->render('comments', [
            'offers' => $offers,
        ]);
    }

    public function actionDeleteComment($id)
    {
        $comment = Comment::findOne($id);
        if(!$comment) {
            throw new NotFoundHttpException("Комментария не найдено!");
        }
        $offer = Offer::findOne($comment->offer_id);
        //$comment->delete();
        if ($comment->delete()) {
                    $offer->updateCounters(['number_comments' => -1]);
                }
        return $this->redirect('/offers/comments');
    }

    public function actionCategory($id)
    {
        $query = Offer::find()->where(['category_id' => $id])->orderBy(['created_at' => SORT_DESC]);
        $totalCount = $query->count();
        $pages = new Pagination([
            'totalCount' => $totalCount,
            'pageSize' => 8,
            'pageSizeParam' => false,
            'forcePageParam' => false,
            ]);
        
        $offers = $query->offset($pages->offset)
        ->limit($pages->limit)
        ->all();
        

         $categories = Category::find()
        ->with('offers')
        ->all();

        $category = Category::findOne($id);
        $categoryName = $category->name;
        //echo AppController::debug($categoryName);
        //die;
        return $this->render('category', [
            'offers' => $offers,
            'categories' => $categories,
            'categoryName' => $categoryName,
            'totalCount' => $totalCount,
            'pages' => $pages,
            'id'=> $id
        ]);
    }
}