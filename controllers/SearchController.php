<?php
namespace app\controllers;

use Yii;

use yii\web\Controller;
use app\models\Offer;
use app\models\SearchForm;
use app\services\OfferSearch;

class SearchController extends Controller 
{
    public function actionIndex()
    {
        $offers = Offer::find()
        ->orderBy(['created_at' => SORT_DESC])
        ->limit(8)
        ->all();
        $publications = [];
        $model = new SearchForm;
        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            if($model->validate()) {
                $offerSearch = new OfferSearch;
                $publications = $offerSearch->getOffers($model->search);
                $title = $offerSearch->getTitle($model->search);

                return $this->render('index', [
                    'offers' => $offers,
                    'publications' =>$publications,
                    'title' => $title
                ]);
            }
        }
        
        return $this->render('index', [
            'offers' => $offers,
            'publications' =>$publications,
            'title' => null
        ]);
    }


}