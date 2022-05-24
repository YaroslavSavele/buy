<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\models\User;
use app\models\SearchForm;
use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

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
    <link rel="icon" href="/img/favicon.ico">
    
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<header class="header">
  <div class="header__wrapper">
    <a class="header__logo logo" href="<?= Url::to('/') ?>">
      <img src="/img/logo.svg" width="179" height="34" alt="Логотип Куплю Продам">
    </a>
    
    <nav class="header__user-menu" <?php if (Yii::$app->user->identity): ?>style="display: block"<?php endif; ?>>
      <ul class="header__list">
        <li class="header__item">
          <a href="<?= Url::to('/offers/my') ?>">Публикации</a>
        </li>
        <li class="header__item">
          <a href="<?= Url::to('/offers/comments') ?>">Комментарии</a>
        </li>
      </ul>
    </nav>

    <?php $model = new SearchForm; 
          if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
          }  
    ?>
    <?php $form = ActiveForm::begin([
            'id' => 'search',
            'method' => 'post',
            'action' => '/search',
            'options' => ['class' => 'search',
                          'autocomplete' => 'off',
            ],
      ]); ?>    
      
      <?php if (Yii::$app->user->identity): ?>
      <?= $form->field($model, 'search', ['options' => ['tag' => false]])->input('search', ['placeholder' => 'Поиск', 'style' => 'width: 256px', ])->label(false); ?>
      <?php else: ?>
      <?= $form->field($model, 'search', ['options' => ['tag' => false]])->input('search', ['placeholder' => 'Поиск'])->label(false); ?>  
      <?php endif; ?>
      <?= Html::submitButton('', ['class' => 'search__icon btn--search']) ?>
    <?php ActiveForm::end() ?>

    <?php if ($id = Yii::$app->user->id): ?>
      <?php $user = User::findOne($id); ?>
    <a class="header__avatar avatar" href="<?= Url::to('/login/logout') ?>" style="display: block">
      <img src="<?= Html::encode($user->avatar); ?>" srcset="/img/avatar@2x.jpg 2x" alt="Аватар пользователя">
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
          <use xlink:href="/img/sprite_auto.svg#logo-htmlac"></use>
        </svg>
      </a>
      <p class="page-footer__copyright">© 2019 Проект Академии</p>
    </div>
    <div class="page-footer__col">
      <a href="<?= Url::to('/') ?>" class="page-footer__logo logo">
        <img src="/img/logo.svg" width="179" height="35" alt="Логотип Куплю Продам">
      </a>
    </div>
    <div class="page-footer__col">
      <ul class="page-footer__nav">
        <li>
          <a href="<?= Url::to('/register') ?>">Вход и регистрация</a>
        </li>
        <li>
          <a href="<?= Url::to('/offers/add') ?>">Создать объявление</a>
        </li>
      </ul>
    </div>
  </div>
</footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
