<?php

/* @var $this \yii\web\View */
/* @var $content string */

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
    <a class="header__avatar avatar" href="#">
      <img src="/img/avatar.jpg" srcset="/img/avatar@2x.jpg 2x" alt="Аватар пользователя">
    </a>
    <a class="header__input" href="sign-up.html">Вход и регистрация</a>
  </div>
</header>
   
      <?= $content; ?>
   

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
