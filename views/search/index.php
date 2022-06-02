<?php
use yii\bootstrap4\Html;
use yii\helpers\Url;

$this->title = 'Результат поиска';
?>

<main class="page-content">
  <section class="search-results">
    <h1 class="visually-hidden">Результаты поиска</h1>
    <div class="search-results__wrapper">

    <?php if (count($publications) > 0) : ?>
      <p class="search-results__label"><?= $title;?></p>
      <ul class="search-results__list">
        <?php foreach ($publications as $publication) : ?>
        <li class="search-results__item">
          <div class="ticket-card ticket-card--color05">
            <div class="ticket-card__img">
              <img src="/<?= Html::encode($publication->img) ?>" srcset="/<?= Html::encode($publication->img) ?>" alt="Изображение товара отсутствует">
            </div>
            <div class="ticket-card__info">
              <span class="ticket-card__label"><?= $publication->getType(); ?></span>
              <div class="ticket-card__categories">
                <a href="<?= Url::to(['/offers/category', 'id' => $publication->category->id]) ?>">
                    <?= Html::encode($publication->category->name) ?>
                </a>
              </div>
              <div class="ticket-card__header">
                <h3 class="ticket-card__title">
                    <a href="<?= Url::to(['/offers/view', 'id' => $publication->id]) ?>">
                        <?= Html::encode($publication->title) ?>
                    </a>
                </h3>
                <p class="ticket-card__price"><span class="js-sum"><?= Html::encode($publication->price) ?></span> ₽</p>
              </div>
              <div class="ticket-card__desc">
                <p><?= Html::encode(substr($publication->description, 0, 155)) ?></p>
              </div>
          </div>
        </li>
        <?php endforeach ?>
      </ul>
    <?php else : ?>
      <div class="search-results__message">
        <p>Не найдено <br>ни&nbsp;одной публикации</p>
      </div>     
    </div>
    <?php endif; ?>
  </section>
  <section class="tickets-list">
    <h2 class="visually-hidden">Самые новые предложения</h2>
    <div class="tickets-list__wrapper">
      <div class="tickets-list__header">
        <p class="tickets-list__title">Самое свежее</p>
      </div>
      <ul>
        <?php if (count($offers) > 0) : ?>
            <?php foreach ($offers as $offer) : ?>
        <li class="tickets-list__item">
          <div class="ticket-card ticket-card--color06">
            <div class="ticket-card__img">
              <img src="/<?= Html::encode($offer->img) ?>" srcset="/<?= Html::encode($offer->img) ?>" alt="Изображение товара отсутствует">
            </div>
            <div class="ticket-card__info">
              <span class="ticket-card__label"><?= $offer->getType(); ?></span>
              <div class="ticket-card__categories">
                <a href="<?= Url::to(['/offers/category', 'id' => $offer->category->id]) ?>">
                    <?= Html::encode($offer->category->name) ?>
                </a>
              </div>
              <div class="ticket-card__header">
                <h3 class="ticket-card__title">
                    <a href="<?= Url::to(['/offers/view', 'id' => $offer->id]) ?>">
                        <?= Html::encode($offer->title) ?>
                    </a>
                </h3>
                <p class="ticket-card__price"><span class="js-sum"><?= Html::encode($offer->price) ?></span> ₽</p>
              </div>
              <div class="ticket-card__desc">
                <p><?= Html::encode(substr($offer->description, 0, 155)) ?></p>
              </div>
            </div>
          </div>
        </li>
            <?php endforeach; ?>
        <?php endif; ?>
        
      </ul>
    </div>
  </section>
</main>
