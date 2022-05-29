<?php

namespace app\services;

use app\models\Offer;

class OfferSearch
{
    public function query($search)
    {
        $query = Offer::find()
                ->where(['like', 'title', $search])
                ->orderBy(['created_at' => SORT_DESC]);
        return $query;        
    }

    public function getOffers($search)
    {
        $publications = $this->query($search)->all();
        
        return $publications;        
    }

    public function getTitle($search)
    {
        $count = $this->query($search)->count();
        $title =$this->get_noun_plural_form($count, 'Найдена', 'Найдено', 'Найдено')
                ." {$count} " 
                .$this->get_noun_plural_form($count, 'публикация', 'публикации', 'публикаций');
                
        return $title;
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
    private function get_noun_plural_form(int $number, string $one, string $two, string $many): string
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