<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;


$this->title = 'Новое объявление';
?>

<main class="page-content">
  <section class="ticket-form">
    <div class="ticket-form__wrapper">
      <h1 class="ticket-form__title">Новая публикация</h1>
      <div class="ticket-form__tile">
        <!--<form class="ticket-form__form form" action="#" method="post" enctype="multipart/form-data" autocomplete="off">-->
        <?php $form = ActiveForm::begin([
            'id' => 'offer-add',
            'method' => 'post',
            'options' => ['class' => 'ticket-form__form form'],
            'fieldConfig' => [
                'template' => "{label}\n{input}\n{error}",
                'inputOptions' => ['class' => 'js-field'],
               ],
      ]); ?>
         <div class="ticket-form__avatar-container js-preview-container">
            <div class="ticket-form__avatar js-preview"></div>
            <div class="ticket-form__field-avatar">
              <input type="file" id="avatar" name="avatar" class="visually-hidden js-file-field">
              <label for="avatar">
                <span class="ticket-form__text-upload">Загрузить фото…</span>
                <span class="ticket-form__text-another">Загрузить другое фото…</span>
              </label>
            </div>
          </div>
          <div class="ticket-form__content">
            <div class="ticket-form__row">
              <div class="form__field">
                <input type="text" name="ticket-name" id="ticket-name" class="js-field" required="">
                <label for="ticket-name">Название</label>
                <span>Обязательное поле</span>
              </div>
            </div>
            <div class="ticket-form__row">
              <div class="form__field">
                <textarea name="comment" id="comment-field" cols="30" rows="10" class="js-field"></textarea>
                <label for="comment-field">Описание</label>
                <span>Обязательное поле</span>
              </div>
            </div>
            <div class="ticket-form__row">
              <select name="category" id="category-field" data-label="Выбрать категорию публикации" class="form__select js-multiple-select">
                <option value="1">Дом</option>
                <option value="2">Спорт и отдых</option>
                <option value="3">Авто</option>
                <option value="4">Электроника</option>
              </select>
            </div>
            <div class="ticket-form__row">
              <div class="form__field form__field--price">
                <input type="number" name="price" id="price-field" class="js-field js-price" min="1" required="">
                <label for="price-field">Цена</label>
                <span>Обязательное поле</span>
              </div>
              <div class="form__switch switch">
                <div class="switch__item">
                  <input type="radio" id="buy-field" name="action" value="buy" class="visually-hidden">
                  <label for="buy-field" class="switch__button">Куплю</label>
                </div>
                <div class="switch__item">
                  <input type="radio" id="sell-field" name="action" value="sell" class="visually-hidden">
                  <label for="sell-field" class="switch__button">Продам</label>
                </div>
              </div>
            </div>
          </div>

          <button class="form__button btn btn--medium js-button" type="submit" disabled="">Опубликовать</button>
        <!--</form>-->
        <?php ActiveForm::end() ?>
      </div>
    </div>
  </section>
</main>