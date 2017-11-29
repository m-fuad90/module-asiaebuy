<?php 


use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$script = <<< JS
$(document).ready(function(){

	$('.in_percentage_dis').change(function(){
	    var value = $( this ).val();

	    if (value == 'Yes') {
	    	$('.showlabel').show();
	    } else {
	    	$('.showlabel').hide();
	    }

	    

	   
	});
}); 
JS;
$this->registerJs($script);
?>


<?php $form = ActiveForm::begin(); ?>


		<?= $form->field($model, 'in_percentage_dis')->radioList(
		          ['Yes'=>'Yes', 'No'=>'No'],
		              ['item' => function($index, $label, $name, $checked, $value) {    
		               $return = '<div class="radio"><label>';
		               $return .= '<input type="radio" class="in_percentage_dis" name="' . $name . '" value="' . $value . '" checked="checked"> ';
		               $return .= $label;
		               $return .= '</label></div>';
		               return $return;
		             }
		           ]
		         )->label('In Percentage ?');

		?>





	<?= $form->field($model, 'discount')->textInput(['type'=>'number','class'=> 'form-control m-input--air'])->label('Discount'.'<span style="display:none;" class="showlabel"> %</span>'); ?>
	 

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary m-btn--air', 'name' => 'login-button']) ?>
    </div>
 
<?php ActiveForm::end(); ?>