<?php

namespace frontend\modules\api\controllers;

use frontend\modules\api\models\User;
use Yii;
use yii\rest\ActiveController;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends ActiveController
{
    /**
     * @inheritdoc
     */
    public $modelClass = 'frontend\modules\api\models\User';

    /**
     * @inheritdoc
     */
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create'], $actions['delete'], $actions['update']); // Отключаем стандартные методы создания и удаления
        return $actions;
    }

    /**
     * Creates a new User model.
     * @return User|array
     */
    public function actionCreate()
    {
        $model = new User();

        // Получаем тело запроса в формате JSON
        $jsonData = Yii::$app->request->getRawBody();

        // Декодируем JSON в массив
        $data = json_decode($jsonData, true);

        // Заполняем модель данными из запроса
        $model->load($data, '');

        // Сохраняем нового пользователя
        if ($model->save()) {
            return $model;
        } else {
            return $model->errors;
        }
    }

    /**
     * Updates an existing User model.
     * @param integer $id
     * @return User|array
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        // Получаем тело запроса в формате JSON
        $jsonData = Yii::$app->request->getRawBody();

        // Декодируем JSON в массив
        $data = json_decode($jsonData, true);

        // Заполняем модель данными из запроса
        $model->load($data, '');

        // Сохраняем обновленные данные
        if ($model->save()) {
            return $model;
        } else {
            return $model->errors;
        }
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws \yii\web\NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new \yii\web\NotFoundHttpException('The requested user does not exist.');
        }
    }
}
