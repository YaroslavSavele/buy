<?php
namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use app\models\Category;
use app\models\Offer;
use app\models\SearchForm;

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
                
                $query = Offer::find()
                        ->where(['like', 'title', "{$model->search}"])
                        ->orderBy(['created_at' => SORT_DESC]);
                $publications = $query->all();
                $count = $query->count();       
                $title =$this->get_noun_plural_form($count, 'Найдена', 'Найдено', 'Найдено')
                 ." {$count} " 
                 .$this->get_noun_plural_form($count, 'публикация', 'публикации', 'публикаций');

                return $this->render('index', [
                    'offers' => $offers,
                    'publications' =>$publications,
                    'count' => $count,
                    'title' => $title
        ]);
            }
        }
        
        
        return $this->render('index', [
            'offers' => $offers,
            'publications' =>$publications
        ]);
    }

    /**
 * Возвращает корректную форму множественного числа
 * Ограничения: только для целых чисел
 *
 * Пример использования:
 * $remaining_minutes = 5;
 * echo "Я поставил таймер на {$remaining_minutes} " .
 *     get_noun_plural_form(
 *         $remaining_minutes,
 *         'минута',
 *         'минуты',
 *         'минут'
 *     );
 * Результат: "Я поставил таймер на 5 минут"
 *
 * @param int $number Число, по которому вычисляем форму множественного числа
 * @param string $one Форма единственного числа: яблоко, час, минута
 * @param string $two Форма множественного числа для 2, 3, 4: яблока, часа, минуты
 * @param string $many Форма множественного числа для остальных чисел
 *
 * @return string Рассчитанная форма множественнго числа
 */
    public function get_noun_plural_form(int $number, string $one, string $two, string $many): string
    {
        $number = (int) $number;
        $mod10 = $number % 10;
        $mod100 = $number % 100;

        switch (true) {
            case ($mod100 >= 11 && $mod100 <= 20):
                return $many;

            case ($mod10 > 5):
                return $many;

            case ($mod10 === 1):
                return $one;

            case ($mod10 >= 2 && $mod10 <= 4):
                return $two;

            default:
                return $many;
        }
    }
}