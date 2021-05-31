<?php
 
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Регистрация';
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
<?= $form->field($model, 'username')->label('Логин') ?>
<?= $form->field($model, 'password')->passwordInput()->label('Пароль') ?>
<?= $form->field($model, 'admin')->checkbox()->label('Аккаунт администратора') ?>
<?= $form->field($model, 'adminPass')->passwordInput()->label('Ключ администратора')?>
<div class="form-group">
    <div>
        <?= Html::submitButton('Регистарция', ['class' => 'btn']) ?>
        <?= yii\helpers\Html::a('Войти',["site/login"], ['class'=>'btn'])?>
    </div>
</div>
<?php ActiveForm::end() ?>