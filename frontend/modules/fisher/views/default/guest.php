<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
$this->title = 'Guest';
$script = <<< JS
$(document).ready(function(){
    $("#obj").width($("#load").width());
    $("#obj").height($("#load").height());
}); 
JS;
$this->registerJs($script);
?>

<style type="text/css">
	.load {
		height:1200px;
    	width:100%;
	}
</style>

<!-- BEGIN SERVICE BOX -->   
<div class="row service-box margin-bottom-40">

     <div class="col-md-12 col-sm-12 load" id="load">



     	<object data="<?php echo $url; ?>" id="obj" type="text/html" >
			<embed src="<?php echo $url; ?>"></embed>
		</object>

     </div>

</div>
<!-- END SERVICE BOX -->
