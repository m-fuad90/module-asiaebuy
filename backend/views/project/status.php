<?php 


use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

use common\models\LookupStatus;
use common\models\LookupDetail;

$status = ArrayHelper::map(LookupStatus::find()->asArray()->all(), 'status', 'status');
$detail = ArrayHelper::map(LookupDetail::find()->where(['status'=>$model->in_time_status])->asArray()->all(), 'details', 'details');


$script = <<< JS
$(document).ready(function(){

	$('.status').change(function(){
		var val = this.value;
        if(val == 'Your item(s) is being shipped with ') {
            $('.shipping').show(); 
            $('.extra').prop('disabled', false);
        } else {
            $('.shipping').hide(); 
            $('.extra').prop('disabled', 'disabled');
        } 
    });

	$('.in_time_status').change(function(){
		var val = this.value;
        if(val == 'Cancel') {
            $('.refund').show(); 
            $('.extra-refund').prop('disabled', false);
        } else {
            $('.refund').hide(); 
            $('.extra-refund').prop('disabled', 'disabled');
        } 




    });




}); 
JS;
$this->registerJs($script);



?>


<?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'in_time_status')->dropDownList(
        $status, 
    [
        'prompt' => '-Choose Status-',
        'class' => 'form-control m-input--air in_time_status',
        'id'=> 'status-id',
        'onchange'=>'$.post("'.Yii::$app->urlManager->createUrl(['/project/statd','status'=>'']).'"+$(this).val(), function(data){$("select#detail-id").html(data);})',

    ])->label('Status') ?>





	<?= $form->field($model, 'detail[status]')->dropDownList($detail,['class'=>'form-control m-input--air status','id'=>'detail-id'])->label('Details'); ?>

	<div class="shipping" style="display: none;">
		
		<textarea name=Status[extra]  class="form-control m-input--air extra" rows=6 disabled="disabled"></textarea>


	</div>
	<div class="refund" style="display: none;">
		
		<textarea name=Status[refund]  class="form-control m-input--air extra-refund" rows=6 disabled="disabled"></textarea>


	</div>



	<br>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary m-btn--air', 'name' => 'login-button']) ?>
    </div>
 
<?php ActiveForm::end(); ?>