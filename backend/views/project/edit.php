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


	var valdis = $('#disperitem').attr('class'); 

	if(valdis == 'Yes') {

		$('.showhidediscount').show();

	} else {
		$('.showhidediscount').hide();
	}

	var valinpercen = $('#inpercentage').attr('class'); 

	if(valinpercen == 'Yes') {

		$('.showhideperitem').hide();

	} else {
		$('.showhideperitem').show();
	}







}); 
JS;
$this->registerJs($script);

?>

<span id="projectId" class="<?php echo $model->_id; ?>"></span>

<?php $form = ActiveForm::begin(); ?>

<div class="row">
	<div class="col-md-6">

		<?= $form->field($model, 'data[item]')->textInput(['class'=>'form-control','value'=>empty($modelItem[0]['data']['item']) ? '': $modelItem[0]['data']['item']])->label('Item'); ?>

		<?= $form->field($model, 'data[specification]')->textArea(['class'=>'form-control spec-info','rows'=>6,'value'=> empty($modelItem[0]['data']['specification']) ? '': $modelItem[0]['data']['specification']])->label('Specification'); ?>

		<?= $form->field($model, 'data[description]')->textArea(['class'=>'form-control desc-info','rows'=>6,'value'=>empty($modelItem[0]['data']['description']) ? '': $modelItem[0]['data']['description']])->label('Description'); ?>

		<?= $form->field($model, 'data[catalog_no]')->textInput(['class'=>'form-control catalog_no','id'=>'catalog_no','value'=> empty($modelItem[0]['data']['catalog_no']) ? '': $modelItem[0]['data']['catalog_no']])->label('Catalog No'); ?>
		
		<?= $form->field($model, 'data[quantity]')->textInput(['class'=>'form-control','type'=>'number','value'=>empty($modelItem[0]['data']['quantity']) ? $modelItem[0]['data']['quantity'] : $modelItem[0]['data']['quantity']])->label('Quantity'); ?>
		
	</div>


	<div class="col-md-6">



		<?= $form->field($model, 'data[price]')->textInput(['class'=>'form-control price-info','type'=>'number','step'=>'any','value'=>empty($modelItem[0]['data']['price']) ? $modelItem[0]['data']['price']: $modelItem[0]['data']['price']])->label('Price'); ?>

		<?= $form->field($model, 'data[freight]')->textInput(['type'=>'number','step'=>'any','class'=>'form-control','value'=>empty($modelItem[0]['data']['freight']) ? $modelItem[0]['data']['freight']: $modelItem[0]['data']['freight']])->label('Freight Charge'); ?>


		<?php if ($modelItem[0]['data']['freight_per_item'] == 'Yes') { ?>


		<div class="form-group field-project-data-freight_per_item">
			<label class="control-label">Freight Charge / Quantity</label>
			<div id="project-data-freight_per_item">
				<div class="radio">
					<label>
						<input type="radio" class="freight_per_item" name="Project[data][freight_per_item]" value="Yes" checked="checked"> Yes
					</label>
				</div>
				<div class="radio">
					<label>
						<input type="radio" class="freight_per_item" name="Project[data][freight_per_item]" value="No"> No
					</label>
				</div>
			</div>


		</div>

		<?php } elseif ($modelItem[0]['data']['freight_per_item'] == 'No' || empty($modelItem[0]['data']['freight_per_item'])) { ?>

		<div class="form-group field-project-data-freight_per_item">
			<label class="control-label">Freight Charge / Quantity</label>
			<div id="project-data-freight_per_item">
				<div class="radio">
					<label>
						<input type="radio" class="freight_per_item" name="Project[data][freight_per_item]" value="Yes" > Yes
					</label>
				</div>
				<div class="radio">
					<label>
						<input type="radio" class="freight_per_item" name="Project[data][freight_per_item]" value="No" checked="checked"> No
					</label>
				</div>
			</div>


		</div>


		<?php } ?>

		<?php if ($modelItem[0]['data']['discount_per_item'] == 'Yes') { ?>

		<span id="disperitem" class="<?php echo $modelItem[0]['data']['discount_per_item']; ?>"></span>


		<div class="form-group field-project-data-discount_per_item">
			<label class="control-label">Discount</label>
			<div id="project-data-discount_per_item">
				<div class="radio">
					<label>
						<input type="radio" class="discount_per_item" name="Project[data][discount_per_item]" value="Yes" checked="checked"> Yes
					</label>
				</div>
				<div class="radio">
					<label>
						<input type="radio" class="discount_per_item" name="Project[data][discount_per_item]" value="No"> No
					</label>
				</div>
			</div>


		</div>



		<?php } elseif ($modelItem[0]['data']['discount_per_item'] == 'No' || empty($modelItem[0]['data']['discount_per_item'])) { ?>

		<div class="form-group field-project-data-discount_per_item">
			<label class="control-label">Discount</label>
			<div id="project-data-discount_per_item">
				<div class="radio">
					<label>
						<input type="radio" class="discount_per_item" name="Project[data][discount_per_item]" value="Yes"> Yes
					</label>
				</div>
				<div class="radio">
					<label>
						<input type="radio" class="discount_per_item" name="Project[data][discount_per_item]" value="No"  checked="checked"> No
					</label>
				</div>
			</div>


		</div>

		<?php } ?>



		<div class="showhidediscount" style="display: none;">


			<div class="box box-warning box-solid"">
	            <div class="box-header with-border">

	            	Discount

	
	            </div>
	 
	            <div class="box-body">

	            	<?php if ($modelItem[0]['data']['in_percentage'] == 'Yes') { ?>

	            	<span id="inpercentage" class="<?php echo $modelItem[0]['data']['in_percentage']; ?>"></span>

						<div class="form-group field-project-data-in_percentage">
							<label class="control-label">In Percentage ?</label>
							<div id="project-data-in_percentage">
								<div class="radio">
									<label>
										<input type="radio" class="in_percentage" name="Project[data][in_percentage]" value="Yes" checked="checked"> Yes
									</label>
								</div>
								<div class="radio">
									<label>
										<input type="radio" class="in_percentage" name="Project[data][in_percentage]" value="No"> No
									</label>
								</div>
							</div>


						</div>

	            	<?php } elseif ($modelItem[0]['data']['in_percentage'] == 'No' || empty($modelItem[0]['data']['in_percentage'])) { ?>


						<div class="form-group field-project-data-in_percentage">
							<label class="control-label">In Percentage ?</label>
							<div id="project-data-in_percentage">
								<div class="radio">
									<label>
										<input type="radio" class="in_percentage" name="Project[data][in_percentage]" value="Yes"> Yes
									</label>
								</div>
								<div class="radio">
									<label>
										<input type="radio" class="in_percentage" name="Project[data][in_percentage]" value="No" checked="checked"> No
									</label>
								</div>
							</div>


						</div>



	            	<?php } ?>




						<?= $form->field($model, 'data[discount_per_item_value]')->textInput(['class'=>'form-control discount_per_item_value','type'=>'number','step'=>'any','value'=>empty($modelItem[0]['data']['discount_per_item_value']) ? $modelItem[0]['data']['discount_per_item_value']: $modelItem[0]['data']['discount_per_item_value']])->label('Value'); ?>


						<div class="showhideperitem">

							<?php if ($modelItem[0]['data']['per_item'] == 'Yes') { ?>


								<div class="form-group field-project-data-per_item">
									<label class="control-label">Discount / Quantity ?</label>
									<div id="project-data-per_item">
										<div class="radio">
											<label>
												<input type="radio" class="per_item" name="Project[data][per_item]" value="Yes" checked="checked"> Yes
											</label>
										</div>
										<div class="radio">
											<label>
												<input type="radio" class="per_item" name="Project[data][per_item]" value="No"> No
											</label>
										</div>
									</div>


								</div>



							<?php } elseif ($modelItem[0]['data']['per_item'] == 'No' || empty($modelItem[0]['data']['per_item'])) { ?>


								<div class="form-group field-project-data-per_item">
									<label class="control-label">Discount / Quantity ?</label>
									<div id="project-data-per_item">
										<div class="radio">
											<label>
												<input type="radio" class="per_item" name="Project[data][per_item]" value="Yes"> Yes
											</label>
										</div>
										<div class="radio">
											<label>
												<input type="radio" class="per_item" name="Project[data][per_item]" value="No" checked="checked"> No
											</label>
										</div>
									</div>


								</div>
							


							<?php } ?>



							

						</div>




	            </div>


	        </div>


			
		</div>



		<?= $form->field($model, 'data[remark]')->textArea(['class'=>'form-control','rows'=>6,'value'=>empty($modelItem[0]['data']['remark']) ? '': $modelItem[0]['data']['remark']])->label('Remark'); ?>



	    <div class="form-group">
	        <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
	    </div>
		
	</div>
</div>


<?php ActiveForm::end(); ?>