<?php

use yii\helpers\Url;
use yii\helpers\HTML;

$activationUrl = Url::to(['/site/activate', 'user' => $user->id, 'token' => $user->uid], true);
echo Yii::t('app', 'Please click on {link}', [
    'link' => HTML::a(Yii::t('app', 'activate_link'), $activationUrl)
]);