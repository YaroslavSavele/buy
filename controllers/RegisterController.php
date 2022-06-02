<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\User;
use yii\web\UploadedFile;
use yii\filters\AccessControl;

class RegisterController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['?'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $model = new User();
        if (Yii::$app->request->isPost) {
            $model->load(\Yii::$app->request->post());
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->validate()) {
                $model->upload();
                $model->password = Yii::$app->security->generatePasswordHash($model->password);
                $model->save(false);
                return $this->goHome();
            }
        }

        return $this->render('index', ['model' => $model]);
    }
}
