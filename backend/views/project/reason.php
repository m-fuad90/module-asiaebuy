<?php 


use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>


<?php $form = ActiveForm::begin(); ?>


	<?= $form->field($model, 'reason_revise')->textArea(['rows'=>6,'class'=>'form-control m-input--air'])->label('Reason'); ?>
	 

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary m-btn--air', 'name' => 'login-button']) ?>
    </div>
 
<?php ActiveForm::end(); ?>