<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;



$this->title = 'Вход';
?>

<main class="page-content">
    <section class="login">
      <h1 class="visually-hidden">Логин</h1>
      <?php $form = ActiveForm::begin([
            'id' => 'login',
            'method' => 'post',
            'options' => ['class' => 'login__form form'],
            'fieldConfig' => [
                'template' => "{label}\n{input}\n{error}",
                'inputOptions' => ['class' => 'js-field'],
               ],
      ]); ?>
      <div class="login__title">
          <a class="login__link" href="<?= Url::to('/register') ?>">Регистрация</a>
          <h2>Вход</h2>
        </div>
        <div class="form__field login__field">
          <?= $form->field($model, 'email')->input('email')->label('Эл. почта'); ?>
          <span>Обязательное поле</span>
        </div>
        <div class="form__field login__field">
          <?= $form->field($model, 'password')->passwordInput()->label('Пароль'); ?>
          <span>Обязательное поле</span>
        </div>
        <?= Html::submitButton('Войти', ['class' => 'login__button btn btn--medium js-button']) ?>
        <a class="btn btn--small btn--flex btn--white" href="#">
          Войти через
          <span class="icon icon--vk"></span>
        </a>
      <?php ActiveForm::end() ?>
    </section>
  </main>