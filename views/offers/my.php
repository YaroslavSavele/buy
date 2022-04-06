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
        <a href="#" class="tickets-list__btn btn btn--big"><span>Новая публикация</span></a>
      </div>
      <ul>
        <li class="tickets-list__item js-card">
          <div class="ticket-card ticket-card--color06">
            <div class="ticket-card__img">
              <img src="/img/item06.jpg" srcset="img/item06@2x.jpg 2x" alt="Изображение товара">
            </div>
            <div class="ticket-card__info">
              <span class="ticket-card__label">ПРОДАМ</span>
              <div class="ticket-card__categories">
                <a href="#">ЭЛЕКТРОНИКА</a>
              </div>
              <div class="ticket-card__header">
                <h3 class="ticket-card__title"><a href="#">Ableton</a></h3>
                <p class="ticket-card__price"><span class="js-sum">88 000</span> ₽</p>
              </div>
            </div>
            <button class="ticket-card__del js-delete" type="button">Удалить</button>
          </div>
        </li>
        <li class="tickets-list__item js-card">
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
            </div>
            <button class="ticket-card__del js-delete" type="button">Удалить</button>
          </div>
        </li>
        <li class="tickets-list__item js-card">
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
            </div>
            <button class="ticket-card__del js-delete" type="button">Удалить</button>
          </div>
        </li>
        <li class="tickets-list__item js-card">
          <div class="ticket-card ticket-card--color08">
            <div class="ticket-card__img">
              <img src="img/item08.jpg" srcset="img/item08@2x.jpg 2x" alt="Изображение товара">
            </div>
            <div class="ticket-card__info">
              <span class="ticket-card__label">Куплю</span>
              <div class="ticket-card__categories">
                <a href="#">ЭЛЕКТРОНИКА</a>
              </div>
              <div class="ticket-card__header">
                <h3 class="ticket-card__title"><a href="#">Фотик Canon</a></h3>
                <p class="ticket-card__price"><span class="js-sum">32 000</span> ₽</p>
              </div>
            </div>
            <button class="ticket-card__del js-delete" type="button">Удалить</button>
          </div>
        </li>
        <li class="tickets-list__item js-card">
          <div class="ticket-card ticket-card--color01">
            <div class="ticket-card__img">
              <img src="img/item01.jpg" srcset="img/item01@2x.jpg 2x" alt="Изображение товара">
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
            </div>
            <button class="ticket-card__del js-delete" type="button">Удалить</button>
          </div>
        </li>
      </ul>
    </div>
  </section>
</main>