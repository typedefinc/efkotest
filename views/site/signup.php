<?php
 
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'SignUp';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
<?php $form = ActiveForm::begin() ?>
<?= $form->field($model, 'username') ?>
<?= $form->field($model, 'password')->passwordInput() ?>
<div class="form-group">
    <div>
        <?= Html::submitButton('Register', ['class' => 'btn']) ?>
    </div>
</div>
<?php ActiveForm::end() ?>