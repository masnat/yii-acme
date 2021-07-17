<?php 
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app', 'Signup');
?>

<h1><?php echo Html::encode($this->title); ?></h1>
<p><?php echo Yii::t('app', 'Please register') ?></p>

<?php $registerForm = ActiveForm::begin([
        'id' => 'register-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

        <?= $registerForm->errorSummary($newUser) ?>

        <?= $registerForm->field($newUser, 'username')->textInput(['autofocus' => true]) ?>

        <?= $registerForm->field($newUser, 'email')->textInput() ?>

        <?= $registerForm->field($newUser, 'password')->passwordInput() ?>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton(Yii::t('app', 'Signup'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>