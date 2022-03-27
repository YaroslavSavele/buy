<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\models\User;
use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://api-maps.yandex.ru/2.1/?apikey=e666f398-c983-4bde-8f14-e3fec900592a&lang=ru_RU" type="text/javascript"></script>
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="icon" href="img/favicon.ico">
    
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<header class="header">
  <div class="header__wrapper">
    <a class="header__logo logo" href="<?= Url::to('/') ?>">
      <img src="/img/logo.svg" width="179" height="34" alt="Логотип Куплю Продам">
    </a>
    <nav class="header__user-menu">
      <ul class="header__list">
        <li class="header__item">
          <a href="my-tickets.html">Публикации</a>
        </li>
        <li class="header__item">
          <a href="comments.html">Комментарии</a>
        </li>
      </ul>
    </nav>
    <form class="search" method="get" action="#" autocomplete="off">
      <input type="search" name="query" placeholder="Поиск" aria-label="Поиск">
      <div class="search__icon"></div>
      <div class="search__close-btn"></div>
    </form>
    <?php if ($id = Yii::$app->user->id): ?>
      <?php $user = User::findOne($id); ?>
    <a class="header__avatar avatar" href="<?= Url::to('/login/logout') ?>" style="display: block">
      <img src="/<?= Html::encode($user->avatar); ?>" srcset="/img/avatar@2x.jpg 2x" alt="Аватар пользователя">
    </a>
    <?php else: ?>
    <a class="header__input" href="<?= Url::to('/register') ?>">Вход и регистрация</a>
    <?php endif; ?>
  </div>
</header>
   
      <?= $content; ?>
   
<footer class="page-footer">
  <div class="page-footer__wrapper">
    <div class="page-footer__col">
      <a href="#" class="page-footer__logo-academy" aria-label="Ссылка на сайт HTML-Академии">
        <svg width="132" height="46">
          <use xlink:href="img/sprite_auto.svg#logo-htmlac"></use>
        </svg>
      </a>
      <p class="page-footer__copyright">© 2019 Проект Академии</p>
    </div>
    <div class="page-footer__col">
      <a href="<?= Url::to('/') ?>" class="page-footer__logo logo">
        <img src="img/logo.svg" width="179" height="35" alt="Логотип Куплю Продам">
      </a>
    </div>
    <div class="page-footer__col">
      <ul class="page-footer__nav">
        <li>
          <a href="sign-up.html">Вход и регистрация</a>
        </li>
        <li>
          <a href="new-ticket.html">Создать объявление</a>
        </li>
      </ul>
    </div>
  </div>
</footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
