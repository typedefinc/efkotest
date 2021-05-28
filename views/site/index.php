<?php
 
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


$this->title = 'List Vacation';
$this->params['breadcrumbs'][] = $this->title;
?>
    <h1 class="col-md-9">
        <?= Html::encode($this->title) ?>
    </h1>

<?php $form = ActiveForm::begin([
    'id' => 'registration-form',
    'enableAjaxValidation' => true,
    'options'=>[
        'class'=>'col-md-9'
    ],

]) ?>
    <?= $form->field($model, 'start')->textInput(['type'=>'date'])?>
        <?= $form->field($model, 'end')->textInput(['type'=>'date'])?>
            <div class="form-group">
                <div>
                    <?= Html::submitButton('Add', ['class' => 'btn btn-success']) ?>
                </div>
            </div>
            <?php ActiveForm::end();?>

            <h3 class='col-md-3  text-right'>
         Role: <?= $isAdmin?'Admin':'User'?>
    </h3>
<table class="table">
    <thead>
        <th>User</th>
        <th>Start</th>
        <th>End</th>
        <th>Checked</th>
        <th></th>
    </thead>
        <tbody>
            <?
            foreach($listing as $list){
            ?><tr>
            <th><?=$list->user?></th>

            <th><?=$list->start?></th>
            <th><?=$list->end;?></th>
            <th><?php
            if($isAdmin){
               echo Html::a($list->locking?'Lock':'Unlock', ['site/edit','id' => ($list->id)]);
            }else{
               echo $list->locking?'Lock':'Unlock';
            }
            ?></th>
            <th style='width:90px;padding:0'>
            <?php if($getName==$list->user && !$list->locking){
                echo '<span data-id="'.$list->id.'" class="glyphicon glyphicon-edit editbtn editor"></span>';
                echo Html::a('<span class="glyphicon glyphicon-remove editbtn"></span>', ['site/delete','id' => ($list->id)]);
            }
            ?>
            </th>
            </tr><?}
            ?>
        </tbody>
</table>

<div class="backModal" style='display:none'>
    <div class='modalForm'>
        <?php $form = ActiveForm::begin([
            'id' => 'update-form',
            'enableAjaxValidation' => true
        ]) ?>
            <?= $form->field($model2, 'id')->hiddenInput() ?>
            <?= $form->field($model2, 'start')->textInput(['type'=>'date'])?>
            <?= $form->field($model2, 'end')->textInput(['type'=>'date'])?>
            <div class="form-group">
                <div>
                    <?= Html::submitButton('Update', ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        <?php ActiveForm::end();?>
        <span class="glyphicon glyphicon-remove close"></span>
    </div>
</div>
