<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Category;
use app\models\Offer;
use app\models\Comment;
use app\models\Chat;
use app\models\ChatKey;
use app\models\User;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;
use yii\data\Pagination;
use yii\filters\AccessControl;
use app\services\ChatShow;

class OffersController extends Controller 
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['add', 'edit', 'my', 'comments'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['add', 'edit', 'my', 'comments'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

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

        if ($model->user_id !== Yii::$app->user->id) {
            
            return $this->goHome();
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
        $chat_key = new ChatKey();
        $user = User::findOne(Yii::$app->user->id);
        $listMessages = [];
        $chatShow = new ChatShow;
        
        if ($autor_id == Yii::$app->user->id) {
            
            if (Yii::$app->request->isPost) {
                $chat_key->load(Yii::$app->request->post());
                if ($chat_key->validate()) {
                    $chat_id = $chat_key->key;
                    $listMessages = $chatShow->showForAuthor($chat, $chat_id, $user, $autor_id);
                }
            }
        } else {
            $listMessages = $chatShow->showForCustomer($chat, $user, $autor_id, $id, $offer);
        }
        

        return $this->render('view', [
            'offer' => $offer,
            'comment' => $comment,
            'reviews' => $reviews,
            'offersCategory' => $offersCategory,
            'chat' => $chat,
            'chat_key' => $chat_key,
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