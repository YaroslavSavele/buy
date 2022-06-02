<?php
use yii\bootstrap4\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

/** @var yii\web\View $this */

$this->title = 'Куплю Продам';
?>
<main class="page-content">
  <section class="categories-list">
    <h1 class="visually-hidden">Сервис объявлений "Куплю - продам"</h1>
    <ul class="categories-list__wrapper">
    <?php foreach ($categories as $category) : ?>
        <?php $adverts = $category->offers; ?>
        <?php if (count($adverts) > 0) : ?>
      <li class="categories-list__item">
        <a href="<?= Url::to(['/offers/category', 'id' => $category->id]) ?>" class="category-tile
            <?php if ($category->id == $id) : ?>
            category-tile--active
            <?php endif; ?>">
          <span class="category-tile__image">
            <img src="/<?= $adverts[0]->img; ?>" srcset="/<?= $adverts[0]->img; ?>" alt="Иконка категории">
          </span>
          <span class="category-tile__label">
              <?= $category->name ?> <span class="category-tile__qty js-qty"><?php echo(count($adverts)); ?></span>
          </span>
        </a>
      </li>
        <?php endif; ?>
    <?php endforeach; ?>
    </ul>
  </section>
  <section class="tickets-list">
    <?php if (count($offers) > 0) : ?>
    <h2 class="visually-hidden">Предложения из категории <?= $categoryName; ?></h2>
    <div class="tickets-list__wrapper">
      <div class="tickets-list__header">
        <p class="tickets-list__title"><?= $categoryName; ?> <b class="js-qty"><?php echo($totalCount); ?></b></p>
      </div>
      <ul>
        
        <?php foreach ($offers as $offer) : ?>
        <li class="tickets-list__item">
          <div class="ticket-card ticket-card--color06">
            <div class="ticket-card__img">
              <img src="/<?= Html::encode($offer->img) ?>" srcset="/<?= Html::encode($offer->img) ?>" alt="Изображение товара отсутствует">
            </div>
            <div class="ticket-card__info">
              <span class="ticket-card__label"><?= $offer->getType(); ?></span>
              <div class="ticket-card__categories">
                <a href="#"><?= Html::encode($offer->category->name) ?></a>
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
    <div class="tickets-list__pagination">
        <ul class="pagination">
          <?php echo LinkPager::widget([
                        'pagination' => $pages,
                        'prevPageLabel' => false,
                        'nextPageLabel' => 'дальше',
                        'disableCurrentPageButton' => true
                    ]); ?>
        </ul>
      </div>
  </section>
 
</main>

