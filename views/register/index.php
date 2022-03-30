<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;



$this->title = 'Регистрация';
?>

<main class="page-content">
    <section class="sign-up">
      <h1 class="visually-hidden">Регистрация</h1>
      <?php $form = ActiveForm::begin([
            'id' => 'sign-up',
            'method' => 'post',
            'options' => ['class' => 'sign-up__form form'],
            'fieldConfig' => [
                'template' => "{label}\n{input}\n{error}",
                'inputOptions' => ['class' => 'js-field'],
               ],
      ]); ?>

        <div class="sign-up__title">
          <h2>Регистрация</h2>
          <a class="sign-up__link" href="<?= Url::to('/login') ?>">Вход</a>
        </div>
        <div class="sign-up__avatar-container js-preview-container">
          <div class="sign-up__avatar js-preview"></div>
          <div class="sign-up__field-avatar">
            <?= $form->field($model, 'imageFile')->fileInput($options = [
               'class' => "visually-hidden js-file-field",
               'id' => "avatar"
            ])->label(false) ?>
            <label for="avatar">
              <span class="sign-up__text-upload">Загрузить аватар…</span>
              <span class="sign-up__text-another">Загрузить другой аватар…</span>
            </label>
            
          </div>
        </div>
        <div class="form__field sign-up__field">
          <?= $form->field($model, 'name')->textInput()->label('Имя и фамилия'); ?>
          <span>Обязательное поле</span>
        </div>
        <div class="form__field sign-up__field">
          <?= $form->field($model, 'email')->input('email')->label('Эл. почта'); ?>
          <span>Неверный email</span>
        </div>
        <div class="form__field sign-up__field">
          <?= $form->field($model, 'password')->passwordInput()->label('Пароль'); ?>
          <span>Обязательное поле</span>
        </div>
        <div class="form__field sign-up__field">
          <?= $form->field($model, 'password_repeat')->passwordInput()->label('Пароль еще раз'); ?>
          <span>Пароли не совпадают</span>
        </div>
        <?= Html::submitButton('Создать аккаунт', ['class' => 'sign-up__button btn btn--medium js-button']) ?>
        <a class="btn btn--small btn--flex btn--white" href="<?= Url::to('site/auth') ?>">
          Войти через
          <span class="icon icon--vk"></span>
        </a>
        <?= yii\authclient\widgets\AuthChoice::widget([
     'baseAuthUrl' => ['site/auth'],
     'popupMode' => false,
]) ?>
      <?php ActiveForm::end() ?>
    </section>
  </main>
