<?php 


use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>


<?php $form = ActiveForm::begin(); ?>


	<?= $form->field($model, 'type_tax')->textInput(['class' => 'form-control m-input--air'])->label('Type Of Tax'); ?>

	<?= $form->field($model, 'tax')->textInput(['type'=>'number','class' => 'form-control m-input--air'])->label('Tax'); ?>
	 

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary m-btn--air', 'name' => 'login-button']) ?>
    </div>
 
<?php ActiveForm::end(); ?>