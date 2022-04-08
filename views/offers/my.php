<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;


$this->title = 'Мои публикации';
?>

<main class="page-content">
  <section class="tickets-list">
    <h2 class="visually-hidden">Самые новые предложения</h2>
    <div class="tickets-list__wrapper">
      <div class="tickets-list__header">
        <a href="<?= Url::to('/offers/add') ?>" class="tickets-list__btn btn btn--big"><span>Новая публикация</span></a>
      </div>
      <ul>
      <?php if (count($offers) > 0): ?>
         <?php foreach ($offers as $offer): ?>
            <li class="tickets-list__item js-card">
               <div class="ticket-card ticket-card--color06">
                  <div class="ticket-card__img">
                  <img src="/<?= Html::encode($offer->img) ?>" srcset="img/item06@2x.jpg 2x" alt="Изображение товара">
                  </div>
                  <div class="ticket-card__info">
                  <span class="ticket-card__label"><?= $offer->getType(); ?></span>
                  <div class="ticket-card__categories">
                     <a href="#"><?= Html::encode($offer->category->name) ?></a>
                  </div>
                  <div class="ticket-card__header">
                     <h3 class="ticket-card__title"><a href="<?= Url::to(['/offers/edit', 'id' => $offer->id]) ?>"><?= Html::encode($offer->title) ?></a></h3>
                     <p class="ticket-card__price"><span class="js-sum"><?= Html::encode($offer->price) ?></span> ₽</p>
                  </div>
                  </div>
                  <button class="ticket-card__del js-delete" type="button">Удалить</button>
               </div>
            </li>
         <?php endforeach; ?>
        <?php endif; ?>
      </ul>
    </div>
  </section>
</main>