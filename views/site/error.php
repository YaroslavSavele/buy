<?php

/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */
/** @var Exception$exception */

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\SearchForm;
use yii\widgets\ActiveForm;

$this->title = $name;
?>

<main class="html-not-found">
    <section class="error">
      <h1 class="error__title"><?= Html::encode($this->title) ?></h1>
      <h2 class="error__subtitle"><?= nl2br(Html::encode($message)) ?></h2>
      <ul class="error__list">
        <li class="error__item">
          <a href="<?= Url::to('/register') ?>">Вход и регистрация</a>
        </li>
        <li class="error__item">
          <a href="<?= Url::to('/offers/add') ?>">Новая публикация</a>
        </li>
        <li class="error__item">
          <a href="<?= Url::to('/') ?>">Главная страница</a>
        </li>
      </ul>
      
      <?php $model = new SearchForm();
        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
        }
        ?>
      <?php $form = ActiveForm::begin([
            'id' => 'error-search',
            'method' => 'post',
            'action' => '/search',
            'options' => ['class' => 'error__search search search--small',
                          'autocomplete' => 'off',
            ],
      ]); ?>
      <?= $form->field($model, 'search', ['options' => ['tag' => false]])
          ->input('search', ['placeholder' => 'Поиск'])->label(false); ?>
      <?= Html::submitButton('', ['class' => 'search__icon btn--search']) ?>
      <?php ActiveForm::end() ?>    
      <a class="error__logo logo" href="<?= Url::to('/') ?>">
        <img src="/img/logo.svg" width="179" height="34" alt="Логотип Куплю Продам">
      </a>
    </section>
  </main>