<?php
use yii\bootstrap4\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */

$this->title = 'Куплю Продам';
?>
<main class="page-content">
  <section class="categories-list">
    <h1 class="visually-hidden">Сервис объявлений "Куплю - продам"</h1>
    <ul class="categories-list__wrapper">
      <li class="categories-list__item">
        <a href="#" class="category-tile category-tile--default">
          <span class="category-tile__image">
            <img src="/img/cat.jpg" srcset="/img/cat@2x.jpg 2x" alt="Иконка категории">
          </span>
          <span class="category-tile__label">Дом <span class="category-tile__qty js-qty">81</span></span>
        </a>
      </li>
      <li class="categories-list__item">
        <a href="#" class="category-tile category-tile--default">
          <span class="category-tile__image">
            <img src="img/cat02.jpg" srcset="img/cat02@2x.jpg 2x" alt="Иконка категории">
          </span>
          <span class="category-tile__label">Электроника <span class="category-tile__qty js-qty">62</span></span>
        </a>
      </li>
      <li class="categories-list__item">
        <a href="#" class="category-tile category-tile--default">
          <span class="category-tile__image">
            <img src="img/cat03.jpg" srcset="img/cat03@2x.jpg 2x" alt="Иконка категории">
          </span>
          <span class="category-tile__label">Одежда <span class="category-tile__qty js-qty">106</span></span>
        </a>
      </li>
      <li class="categories-list__item">
        <a href="#" class="category-tile category-tile--default">
          <span class="category-tile__image">
            <img src="img/cat04.jpg" srcset="img/cat04@2x.jpg 2x" alt="Иконка категории">
          </span>
          <span class="category-tile__label">Спорт/отдых <span class="category-tile__qty js-qty">86</span></span>
        </a>
      </li>
      <li class="categories-list__item">
        <a href="#" class="category-tile category-tile--default">
          <span class="category-tile__image">
            <img src="img/cat05.jpg" srcset="img/cat05@2x.jpg 2x" alt="Иконка категории">
          </span>
          <span class="category-tile__label">Авто <span class="category-tile__qty js-qty">34</span></span>
        </a>
      </li>
      <li class="categories-list__item">
        <a href="#" class="category-tile category-tile--default">
          <span class="category-tile__image">
            <img src="img/cat06.jpg" srcset="img/cat06@2x.jpg 2x" alt="Иконка категории">
          </span>
          <span class="category-tile__label">Книги <span class="category-tile__qty js-qty">92</span></span>
        </a>
      </li>
    </ul>
  </section>
  <section class="tickets-list">
    <h2 class="visually-hidden">Самые новые предложения</h2>
    <div class="tickets-list__wrapper">
      <div class="tickets-list__header">
        <p class="tickets-list__title">Самое свежее</p>
      </div>
      <ul>
        <?php if (count($offers) > 0): ?>
        <?php foreach ($offers as $offer): ?>  
        <li class="tickets-list__item">
          <div class="ticket-card ticket-card--color06">
            <div class="ticket-card__img">
              <img src="/<?= Html::encode($offer->img) ?>" srcset="img/item01@2x.jpg 2x" alt="Изображение товара отсутствует">
            </div>
            <div class="ticket-card__info">
              <span class="ticket-card__label"><?= $offer->getType(); ?></span>
              <div class="ticket-card__categories">
                <a href="#"><?= Html::encode($offer->category->name) ?></a>
              </div>
              <div class="ticket-card__header">
                <h3 class="ticket-card__title"><a href="<?= Url::to(['/offers/view', 'id' => $offer->id]) ?>"><?= Html::encode($offer->title) ?></a></h3>
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
  <section class="tickets-list">
    <h2 class="visually-hidden">Самые обсуждаемые предложения</h2>
    <div class="tickets-list__wrapper">
      <div class="tickets-list__header">
        <p class="tickets-list__title">Самые обсуждаемые</p>
      </div>
      <ul>
        <li class="tickets-list__item">
          <div class="ticket-card ticket-card--color09">
            <div class="ticket-card__img">
              <img src="img/item09.jpg" srcset="img/item09@2x.jpg 2x" alt="Изображение товара">
            </div>
            <div class="ticket-card__info">
              <span class="ticket-card__label">Куплю</span>
              <div class="ticket-card__categories">
                <a href="#">Дом</a>
              </div>
              <div class="ticket-card__header">
                <h3 class="ticket-card__title"><a href="#">Монстера</a></h3>
                <p class="ticket-card__price"><span class="js-sum">1000</span> ₽</p>
              </div>
              <div class="ticket-card__desc">
                <p>Куплю монстеру зеленую в хорошем зеленом состоянии, буду поливать...</p>
              </div>
            </div>
          </div>
        </li>
        <li class="tickets-list__item">
          <div class="ticket-card ticket-card--color10">
            <div class="ticket-card__img">
              <img src="img/item10.jpg" srcset="img/item10@2x.jpg 2x" alt="Изображение товара">
            </div>
            <div class="ticket-card__info">
              <span class="ticket-card__label">ПРОДАМ</span>
              <div class="ticket-card__categories">
                <a href="#">Дом</a>
              </div>
              <div class="ticket-card__header">
                <h3 class="ticket-card__title"><a href="#">Мое старое кресло</a></h3>
                <p class="ticket-card__price"><span class="js-sum">4000</span> ₽</p>
              </div>
              <div class="ticket-card__desc">
                <p>Продам свое старое кресло, чтобы сидеть и читать книги зимними...</p>
              </div>
            </div>
          </div>
        </li>
        <li class="tickets-list__item">
          <div class="ticket-card ticket-card--color11">
            <div class="ticket-card__img">
              <img src="img/item11.jpg" srcset="img/item11@2x.jpg 2x" alt="Изображение товара">
            </div>
            <div class="ticket-card__info">
              <span class="ticket-card__label">ПРОДАМ</span>
              <div class="ticket-card__categories">
                <a href="#">ЭЛЕКТРОНИКА</a>
              </div>
              <div class="ticket-card__header">
                <h3 class="ticket-card__title"><a href="#">Дедушкины часы</a></h3>
                <p class="ticket-card__price"><span class="js-sum">45 000</span> ₽</p>
              </div>
              <div class="ticket-card__desc">
                <p>Продаю дедушкины часы в&nbsp;прекрасном состоянии, ходят до...</p>
              </div>
            </div>
          </div>
        </li>
        <li class="tickets-list__item">
          <div class="ticket-card ticket-card--color04">
            <div class="ticket-card__img">
              <img src="img/item04.jpg" srcset="img/item04@2x.jpg 2x" alt="Изображение товара">
            </div>
            <div class="ticket-card__info">
              <span class="ticket-card__label">Куплю</span>
              <div class="ticket-card__categories">
                <a href="#">Дом</a>
              </div>
              <div class="ticket-card__header">
                <h3 class="ticket-card__title"><a href="#">Кофеварка</a></h3>
                <p class="ticket-card__price"><span class="js-sum">2000</span> ₽</p>
              </div>
              <div class="ticket-card__desc">
                <p>Куплю вот такую итальянскую кофеварку, можно любой фирмы...</p>
              </div>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </section>
</main>

