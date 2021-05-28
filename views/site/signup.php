<?php
 
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'SignUp';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
<?php $form = ActiveForm::begin([
    'id' => 'signup-form',
    'enableAjaxValidation' => true,
    'options'=>[
        'class'=>'',
    ],
    'fieldConfig' => [
        'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
        'labelOptions' => ['class' => 'col-lg-1 control-label'],
    ],
]) ?>
<?= $form->field($model, 'username') ?>
<?= $form->field($model, 'password')->passwordInput() ?>
<?= $form->field($model, 'admin')->checkbox() ?>
<?= $form->field($model, 'adminPass')->passwordInput()?>
<div class="form-group">
    <div>
        <?= Html::submitButton('Register', ['class' => 'btn']) ?>
        <?= yii\helpers\Html::a('Login',["site/login"], ['class'=>'btn'])?>
    </div>
</div>
<?php ActiveForm::end() ?>