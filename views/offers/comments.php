<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\models\User;
use app\models\Comment;


$this->title = 'Комментарии к моим публикациям';
?>

<main class="page-content">
  <section class="comments">
    <div class="comments__wrapper">
      <h1 class="visually-hidden">Страница комментариев</h1>
      <?php if (count($offers) > 0): ?>
        <?php foreach ($offers as $offer): ?>
      <div class="comments__block">
        <div class="comments__header">
          <a href="<?= Url::to(['/offers/view', 'id' => $offer->id]) ?>" class="announce-card">
            <h2 class="announce-card__title"><?= Html::encode($offer->title) ?></h2>
            <span class="announce-card__info">
              <span class="announce-card__price">₽ <?= Html::encode($offer->price) ?></span>
              <span class="announce-card__type"><?= $offer->getType(); ?></span>
            </span>
          </a>
        </div>
        <ul class="comments-list">
        <?php $comments = $offer->comments; ?>
          <?php foreach ($comments as $comment): ?>
          <li class="js-card">
            <div class="comment-card">
              <div class="comment-card__header">
                <a href="#" class="comment-card__avatar avatar">
                  <img src="<?= Html::encode($comment->user->avatar) ?>" srcset="img/avatar03@2x.jpg 2x" alt="Аватар пользователя">
                </a>
                <p class="comment-card__author"><?= Html::encode($comment->user->name) ?></p>
              </div>
              <div class="comment-card__content">
                <p><?= Html::encode($comment->text) ?></p>
              </div>
              <a class="comment-card__delete js-delete" href="<?= Url::to(['/offers/delete-comment', 'id' => $comment->id]) ?>" type="button">Удалить</a>
            </div>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>
        <?php endforeach; ?>
      <?php else: ?>
          <p class="comments__message">У ваших публикаций еще нет комментариев.</p>
      <?php endif; ?>
      
    </div>
  </section>
</main>