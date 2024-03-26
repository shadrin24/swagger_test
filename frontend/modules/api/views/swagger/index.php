<?php

use yii\helpers\Url;
use yii\web\View;

$this->registerJsFile('https://cdn.jsdelivr.net/npm/swagger-ui-dist@3/swagger-ui-bundle.js', ['depends' => 'yii\web\YiiAsset']);
$this->registerJsFile('https://cdn.jsdelivr.net/npm/swagger-ui-dist@3/swagger-ui-standalone-preset.js', ['depends' => 'yii\web\YiiAsset']);
$this->registerCssFile('https://cdn.jsdelivr.net/npm/swagger-ui-dist@3/swagger-ui.css');

$this->registerJs(<<<JS
window.onload = function() {
  window.ui = SwaggerUIBundle({
    url: "{$url}",
    dom_id: '#swagger-ui',
    presets: [
      SwaggerUIBundle.presets.apis,
      SwaggerUIStandalonePreset
    ],
    layout: "StandaloneLayout"
  });
};
JS
    , View::POS_END);

echo '<div id="swagger-ui"></div>';