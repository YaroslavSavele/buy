<?php
use yii\bootstrap4\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */

$this->title = 'Регистрация';
?>
<main class="page-content">
    <section class="sign-up">
      <h1 class="visually-hidden">Регистрация</h1>
      <!--<form class="sign-up__form form" action="#" method="post" enctype="multipart/form-data" autocomplete="off">-->
      <?php $form = ActiveForm::begin([
    'id' => 'sign-up__form',
    'method' => 'post',
    'options' => ['class' => 'sign-up__form form'],
]) ?>
        <div class="sign-up__title">
          <h2>Регистрация</h2>
          <a class="sign-up__link" href="login.html">Вход</a>
        </div>
        <div class="sign-up__avatar-container js-preview-container">
          <div class="sign-up__avatar js-preview"></div>
          <div class="sign-up__field-avatar">
            <input type="file" id="avatar" name="avatar" class="visually-hidden js-file-field">
            <label for="avatar">
              <span class="sign-up__text-upload">Загрузить аватар…</span>
              <span class="sign-up__text-another">Загрузить другой аватар…</span>
            </label>
          </div>
        </div>
        <div class="form__field sign-up__field">
          <input type="text" name="user-name" id="user-name" class="js-field" required="">
          <label for="user-name">Имя и фамилия</label>
          <span>Обязательное поле</span>
          <?= $form->field($model, 'name')->textInput()->label('Имя и фамилия'); ?>
        </div>
        <div class="form__field sign-up__field">
          <input type="email" name="user-email" id="user-email" class="js-field" required="">
          <label for="user-email">Эл. почта</label>
          <span>Неверный email</span>
        </div>
        <div class="form__field sign-up__field">
          <input type="password" name="user-password" id="user-password" class="js-field" required="">
          <label for="user-password">Пароль</label>
          <span>Обязательное поле</span>
        </div>
        <div class="form__field sign-up__field">
          <input type="password" name="user-password-again" id="user-password-again" class="js-field" required="">
          <label for="user-password-again">Пароль еще раз</label>
          <span>Пароли не совпадают</span>
        </div>
        <button class="sign-up__button btn btn--medium js-button" type="submit" disabled="">Создать аккаунт</button>
        <a class="btn btn--small btn--flex btn--white" href="#">
          Войти через
          <span class="icon icon--vk"></span>
        </a>
      <!--</form>-->
      <?php ActiveForm::end() ?>
    </section>
  </main>
