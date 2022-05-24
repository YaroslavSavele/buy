<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\models\User;


$this->title = 'Публикация';
?>

<main class="page-content">
  <section class="ticket">
    <div class="ticket__wrapper">
      <h1 class="visually-hidden">Карточка объявления</h1>
      <div class="ticket__content">
        <div class="ticket__img">
          <img src="/<?= Html::encode($offer->img) ?>" srcset="img/ticket@2x.jpg 2x" alt="Изображение товара отсутствует">
        </div>
        <div class="ticket__info">
          <h2 class="ticket__title"><?= Html::encode($offer->title) ?></h2>
          <div class="ticket__header">
            <p class="ticket__price"><span class="js-sum"><?= Html::encode($offer->price) ?></span> ₽</p>
            <p class="ticket__action"><?= $offer->getType(); ?></p>
          </div>
          <div class="ticket__desc">
            <p><?= Html::encode($offer->description) ?></p>
          </div>
          <div class="ticket__data">
            <p>
              <b>Дата добавления:</b>
              <?php  Yii::$app->formatter->locale = 'ru-RU'; ?>
              <span><?= Yii::$app->formatter->asDate($offer->created_at, 'long');?></span>
            </p>
            <p>
              <b>Автор:</b>
              <a href="#"><?= Html::encode($offer->user->name) ?></a>
            </p>
            <p>
              <b>Контакты:</b>
              <a href="mailto:shkatulkin@ya.ru"><?= Html::encode($offer->user->email) ?></a>
            </p>
          </div>
          <ul class="ticket__tags">
            <li>
              <a href="<?= Url::to(['/offers/category', 'id' => $offer->category->id]) ?>" class="category-tile category-tile--small">
                <span class="category-tile__image">
                  <img src="/<?= Html::encode($offersCategory[0]->img) ?>" srcset="img/cat@2x.jpg 2x" alt="Иконка категории">
                </span>
                <span class="category-tile__label"><?= Html::encode($offer->category->name) ?></span>
              </a>
            </li>
          </ul>
        </div>
      </div>
      <div class="ticket__comments">
        <?php if ($id = Yii::$app->user->id): ?>
        <?php $user = User::findOne($id); ?>  
        <h2 class="ticket__subtitle">Коментарии</h2>
        <div class="ticket__comment-form">
          <?php $form = ActiveForm::begin([
            'id' => 'comment-add',
            'method' => 'post',
            'options' => ['class' => 'form comment-form'],
            'fieldConfig' => [
                'template' => "{label}\n{input}\n{error}",
                'inputOptions' => ['class' => 'js-field'],
               ],
          ]); ?>    
            <div class="comment-form__header">
              <a href="#" class="comment-form__avatar avatar">
                <img src="<?= Html::encode($user->avatar); ?>" srcset="/img/avatar@2x.jpg 2x" alt="Аватар пользователя">
              </a>
              <p class="comment-form__author">Вам слово</p>
            </div>
            <div class="comment-form__field">
              <div class="form__field">
                <?= $form->field($comment, 'text')->textarea(['value' => ''])->label('Текст комментария'); ?>
                <span>Обязательное поле</span>
              </div>
            </div>
            <button class="comment-form__button btn btn--white js-button" type="submit" disabled="">Отправить</button>
        <?php ActiveForm::end() ?>  
        </div>
        <?php else: ?>
        <div class="ticket__warning">
          <p>Отправка комментариев доступна <br>только для зарегистрированных пользователей.</p>
          <a href="<?= Url::to('/register') ?>" class="btn btn--big">Вход и регистрация</a>
        </div>
        <h2 class="ticket__subtitle">Коментарии</h2>
        <?php endif; ?>    
        <?php if (count($reviews) > 0): ?>
        <div class="ticket__comments-list">
          <ul class="comments-list">
          <?php foreach ($reviews as $review): ?>    
            <li>
              <div class="comment-card">
                <div class="comment-card__header">
                  <a href="#" class="comment-card__avatar avatar">
                    <img src="<?= Html::encode($review->user->avatar) ?>" srcset="img/avatar02@2x.jpg 2x" alt="Аватар пользователя">
                  </a>
                  <p class="comment-card__author"><?= Html::encode($review->user->name) ?></p>
                </div>
                <div class="comment-card__content">
                  <p><?= Html::encode($review->text) ?></p>
                </div>
              </div>
            </li>
            <li>
          <?php endforeach; ?>      
          </ul>
        </div>
        <?php else: ?>
        <div class="ticket__message">
          <p>У этой публикации еще нет ни одного комментария.</p>
        </div>
        <?php endif; ?>
      </div>
      <?php if (Yii::$app->user->identity): ?>
      <button class="chat-button" type="button" aria-label="Открыть окно чата"></button>
      <?php endif; ?>  
    </div>
  </section>
</main>
<?php if (Yii::$app->user->identity): ?>
<section class="chat visually-hidden">
  <h2 class="chat__subtitle">Чат с продавцом</h2>
  <?php if (count($listMessages) > 0): ?>
  <ul class="chat__conversation">
    <?php foreach ($listMessages as $message): ?>  
    <li class="chat__message">
      <div class="chat__message-title">
        <span class="chat__message-author"><?= Html::encode(ArrayHelper::getValue($message, 'user_name')) ?></span>
        <time class="chat__message-time" datetime="2021-11-18T21:15"><?= ArrayHelper::getValue($message, 'created_at') ?></time>
      </div>
      <div class="chat__message-content">
        <p><?= Html::encode(ArrayHelper::getValue($message, 'text')) ?></p>
      </div>
    </li>
    <?php endforeach; ?>
  </ul>
  <?php endif; ?>
  <?php $form = ActiveForm::begin([
            'id' => 'chat__form',
            'method' => 'post',
            'options' => ['class' => 'chat__form'],
            'fieldConfig' => [
                'inputOptions' => ['class' => 'chat__form-message'],
               ],
          ]); ?>        
    <label class="visually-hidden" for="chat-field">Ваше сообщение в чат</label>
    <?= $form->field($chat, 'text', ['options' => ['tag' => false]])->textarea(['placeholder' => 'Ваше сообщение', 'value' => ''])->label(false); ?>
    <?php if ($offer->user_id == Yii::$app->user->id): ?>
    <?= $form->field($chat, 'key', ['options' => ['tag' => false]])->textInput(['class' => 'visually-hidden', 'placeholder' => 'Ключ чата', 'value' => $chat->key])->label(false); ?>
    <?php endif; ?>
    <?= Html::submitButton('', ['class' => 'chat__form-button']) ?>
  <?php ActiveForm::end() ?>
  <?php if ($offer->user_id == Yii::$app->user->id): ?>
  <?php $form = ActiveForm::begin([
            'id' => 'chat-id__form',
            'method' => 'post',
            'options' => ['class' => 'chat__form key__form'],
            'fieldConfig' => [
                'inputOptions' => ['class' => 'chat__form-message'],
               ],
          ]); ?>        
    <label class="visually-hidden" for="chat-field">Ваше сообщение в чат</label>
    <?= $form->field($chat_key, 'key', ['options' => ['tag' => false]])->textInput(['placeholder' => 'Введите ключ чата'])->label(false); ?>
    <?= Html::submitButton('', ['class' => 'chat__form-button']) ?>
  <?php ActiveForm::end() ?>
  <?php endif; ?>
</section>
<?php endif; ?>