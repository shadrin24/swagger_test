<?php

namespace app\controllers;

use yii\web\Controller;
use yii\web\Response;
use zircote\swagger\SwaggerControllerAsset;

class SwaggerController extends Controller
{
    public function actionIndex()
    {
        return $this->render('@frontend/modules/api/views/swagger/index', [
            'url' => Url::to(['swagger/json'], true),
        ]);
    }

    public function actionJson()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;

        $swagger = \Swagger\scan(\Yii::getAlias('@app/controllers'));
        return json_encode($swagger);
    }
}