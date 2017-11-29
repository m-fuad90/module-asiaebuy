<?php 


use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$script = <<< JS
$(document).ready(function(){

	$('.discount_per_item').change(function(){
	    var value = $( this ).val();

	    if (value == 'Yes') {
	    	$('.showhidediscount').show();
	    } else {
	    	$('.showhidediscount').hide();
	    }
	   
	});

	$('.in_percentage').change(function(){
	    var value = $( this ).val();

	    if (value == 'Yes') {
	    	$('.showhideperitem').hide();
	    } else {
	    	$('.showhideperitem').show();
	    }
	   
	});


	$('.catalog_no').keyup(function() {

		var ctg = $('#catalog_no').val();
		var id = $('#projectId').attr('class'); 

		$.ajax({
            type: 'POST',
            url: 'check-price',
            data: 'ctg='+ctg+'&id='+id,
            dataType: 'json',
			success: function(data) { 

                $(".price-info").val(data[0]);
                $(".desc-info").val(data[1]);
                $(".spec-info").val(data[2]);

            }


            
        })
		
	    
	});


}); 
JS;
$this->registerJs($script);

?>

<span id="projectId" class="<?php echo $model->_id; ?>"></span>



<?php $form = ActiveForm::begin(); ?>

<div class="row">
	<div class="col-md-6">



		<?= $form->field($model, 'data[item]')->textInput(['class'=>'form-control'])->label('Item'); ?>

		<?= $form->field($model, 'data[specification]')->textArea(['rows'=>6,'class'=>'form-control spec-info'])->label('Specification'); ?>

		<?= $form->field($model, 'data[description]')->textArea(['rows'=>6,'class'=>'form-control desc-info'])->label('Description'); ?>

		<?= $form->field($model, 'data[catalog_no]')->textInput(['class'=>'form-control catalog_no','id'=>'catalog_no'])->label('Catalog No'); ?>
		
		<?= $form->field($model, 'data[quantity]')->textInput(['type'=>'number','class'=>'form-control','value' => 0])->label('Quantity'); ?>

		
	</div>


	<div class="col-md-6">



		<?= $form->field($model, 'data[price]')->textInput(['type'=>'number','step'=>'any','class'=>'form-control price-info','value' => 0])->label('Price'); ?>

		<?= $form->field($model, 'data[freight]')->textInput(['type'=>'number','step'=>'any','class'=>'form-control','value' => 0])->label('Freight Charge'); ?>


		<?= $form->field($model, 'data[freight_per_item]')->radioList(
		          ['Yes'=>'Yes', 'No'=>'No'],
		              ['item' => function($index, $label, $name, $checked, $value) {    
		               $return = '<div class="radio"><label>';
		               $return .= '<input type="radio" class="freight_per_item" name="' . $name . '" value="' . $value . '" checked="checked"> ';
		               $return .= $label;
		               $return .= '</label></div>';
		               return $return;
		             }
		           ]
		         )->label('Freight Charge / Quantity');

		?>





		<?= $form->field($model, 'data[discount_per_item]')->radioList(
		          ['Yes'=>'Yes', 'No'=>'No'],
		              ['item' => function($index, $label, $name, $checked, $value) {    
		               $return = '<div class="radio"><label>';
		               $return .= '<input type="radio" class="discount_per_item" name="' . $name . '" value="' . $value . '" checked="checked"> ';
		               $return .= $label;
		               $return .= '</label></div>';
		               return $return;
		             }
		           ]
		         )->label('Discount');

		?>


		<div class="showhidediscount" style="display: none;">

			<div class="box box-warning box-solid"">
	            <div class="box-header with-border">

	            	Discount

	
	            </div>
	 
	            <div class="box-body">

					<?= $form->field($model, 'data[in_percentage]')->radioList(
					          ['Yes'=>'Yes', 'No'=>'No'],
					              ['item' => function($index, $label, $name, $checked, $value) {    
					               $return = '<div class="radio"><label>';
					               $return .= '<input type="radio" class="in_percentage" name="' . $name . '" value="' . $value . '" checked="checked"> ';
					               $return .= $label;
					               $return .= '</label></div>';
					               return $return;
					             }
					           ]
					         )->label('In Percentage ?');

					?>


						<?= $form->field($model, 'data[discount_per_item_value]')->textInput(['type'=>'number','step'=>'any','class'=>'form-control','value' => 0])->label('Value'); ?>


						<div class="showhideperitem">


						<?= $form->field($model, 'data[per_item]')->radioList(
					          ['Yes'=>'Yes', 'No'=>'No'],
					              ['item' => function($index, $label, $name, $checked, $value) {    
					               $return = '<div class="radio"><label>';
					               $return .= '<input type="radio" class="per_item" name="' . $name . '" value="' . $value . '" checked="checked"> ';
					               $return .= $label;
					               $return .= '</label></div>';
					               return $return;
					             }
					           ]
					         )->label('Discount / Quantity ?');

							?>
							

						</div>



	            </div>

	        </div>

			
		</div>



		<?= $form->field($model, 'data[remark]')->textArea(['rows'=>6,'class'=>'form-control'])->label('Remark'); ?>



	    <div class="form-group">
	        <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
	    </div>
		
	</div>
</div>


<?php ActiveForm::end(); ?>