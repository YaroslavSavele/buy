<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;


$this->title = 'Новое объявление';
?>

<main class="page-content">
  <section class="ticket-form">
    <div class="ticket-form__wrapper">
      <h1 class="ticket-form__title">Новая публикация</h1>
      <div class="ticket-form__tile">
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
              <?= $form->field($model, 'imageFile')->fileInput($options = [
               'class' => "visually-hidden js-file-field",
               'id' => "avatar"
              ])->label(false) ?>
              <label for="avatar">
                <span class="ticket-form__text-upload">Загрузить фото…</span>
                <span class="ticket-form__text-another">Загрузить другое фото…</span>
              </label>
            </div>
          </div>
          <div class="ticket-form__content">
            <div class="ticket-form__row">
              <div class="form__field">
                <?= $form->field($model, 'title')->textInput()->label('Название'); ?>
                <span>Обязательное поле</span>
              </div>
            </div>
            <div class="ticket-form__row">
              <div class="form__field">
                <!--<textarea name="comment" id="comment-field" cols="30" rows="10" class="js-field"></textarea>
                <label for="comment-field">Описание</label>-->
                <?= $form->field($model, 'description')->textarea()->label('Описание'); ?>
                <span>Обязательное поле</span>
              </div>
            </div>
            <div class="ticket-form__row">
              <!--<select name="category" id="category-field" data-label="Выбрать категорию публикации" class="form__select js-multiple-select">
                <option value="1">Дом</option>
                <option value="2">Спорт и отдых</option>
                <option value="3">Авто</option>
                <option value="4">Электроника</option>
              </select>-->
              <?= $form->field($model, 'category_id', ['options' => ['tag' => false]])->dropDownList(ArrayHelper::map($categories, 'id', 'name',), 
              [
                 'prompt' => '',
                 'id' => 'category-field',
                 'class' => 'form__select js-multiple-select',
                 'data-label' => 'Выбрать категорию публикации',
              ])->label(false); ?>
            </div>
            <div class="ticket-form__row">
              <div class="form__field form__field--price">
                <?= $form->field($model, 'price')->input('number', ['class' => 'js-field js-price', 'id' => 'price-field'])->label('Цена'); ?>
                <!--, ['options' => ['tag' => false]]-->
                <span>Обязательное поле</span>
              </div>
              <div class="form__switch switch">
                <div class="switch__item">
                  <!--<input type="radio" id="buy-field" name="action" value="buy" class="visually-hidden">-->
                  <?= $form->field($model, 'type', ['options' => ['tag' => false], 'template' => "{error}\n{label}\n{input}"])->radio(['class' => 'visually-hidden', 'id' => 'buy-field', 'value' => 1, 'label' => null]); ?>
                  <label for="buy-field" class="switch__button">Куплю</label>
                </div>
                <div class="switch__item">
                  <!--<input type="radio" id="sell-field" name="action" value="sell" class="visually-hidden">-->
                  <?= $form->field($model, 'type', ['options' => ['tag' => false], 'template' => "{error}\n{label}\n{input}"])->radio(['class' => 'visually-hidden', 'id' => 'sell-field', 'value' => 2, 'label' => null]); ?>
                  <label for="sell-field" class="switch__button">Продам</label>
                </div>
              </div>
            </div>
          </div>

            <!--<button class="form__button btn btn--medium js-button" type="submit" disabled="">Опубликовать</button>-->
          <?= Html::submitButton('Опубликовать', ['class' => 'form__button btn btn--medium js-button']) ?>
        <?php ActiveForm::end() ?>
      </div>
    </div>
  </section>
</main>