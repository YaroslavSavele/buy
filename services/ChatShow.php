<?php
namespace app\services;

use Yii;
use app\models\Chat;
use app\models\User;
use app\models\Offer;

class ChatShow 
{
    public function showForAuthor(Chat $chat, $chat_id, User $user, int $autor_id)
    {
        $listMessages = $chat->get($chat_id);
        $chat->key = $chat_id;
                    
        $chat->load(Yii::$app->request->post());
        if ($chat->validate()) {
                        
            if ($chat->write([
                        'user_name' => $user->name,
                        'text' => $chat->text,
                        'created_at' => date('H:i'),
                        'autor_id' => $autor_id,
                        ], $chat->key)) {
                            $listMessages = $chat->get($chat->key);
                        }
                    }    
                
        return $listMessages;    
    }
    public function showForCustomer(Chat $chat, User $user, int $autor_id, int $id, Offer $offer) 
    {
        
        $chat_id = $id . '-' . Yii::$app->user->id;
        $listMessages = $chat->get($chat_id);
        if (!isset($listMessages)) {
            $listMessages = [];
        }
        
        if(Yii::$app->request->isPost) {
            $chat->load(Yii::$app->request->post());
            if ($chat->validate()) {
                
                if($chat->write([
                    'user_name' => $user->name,
                    'text' => $chat->text,
                    'created_at' => date('H:i'),
                    'autor_id' => $autor_id,
                    ], $chat_id)) {
                        Yii::$app->mailer->compose()
                            ->setFrom('hero34@mail.ru')
                            ->setTo($offer->user->email)
                            ->setSubject('Уведомление с сайта byu.loc') 
                            ->setTextBody("Для вас есть сообщение в чате, перейдите в разговор по ключу $chat_id")
                            ->send();
                            $listMessages = $chat->get($chat_id);
                        } 
                
            }
        }
        //var_dump($listMessages);die;
        return $listMessages;
    }
    
}