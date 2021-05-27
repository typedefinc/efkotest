<?php
 
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
    <h1>
        <?= Html::encode($this->title) ?>
    </h1>
    <?php if( Yii::$app->session->hasFlash('error') ): ?>
    <div class="alert alert-error alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo Yii::$app->session->getFlash('error'); ?>
    </div>
    <?php endif;?>
  
<?php $form = ActiveForm::begin([
    'id' => 'registration-form',
    'enableAjaxValidation' => true
]) ?>
    <?= $form->field($model, 'start')->textInput(['type'=>'date'])?>
        <?= $form->field($model, 'end')->textInput(['type'=>'date'])?>
            <div class="form-group">
                <div>
                    <?= Html::submitButton('Add', ['class' => 'btn btn-success']) ?>
                </div>
            </div>
            <?php ActiveForm::end();?>


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
            <th style='width:90px'>
            <?php if($getName==$list->user && !$list->locking){
                echo '<span class="glyphicon glyphicon-edit editbtn editor"></span>';
                echo Html::a('<span class="glyphicon glyphicon-remove editbtn"></span>', ['site/delete','id' => ($list->id)]);
            }
            ?>
            </th>
            </tr><?}
            ?>
        </tbody>
</table>
