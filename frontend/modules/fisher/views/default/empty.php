<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
$this->title = 'Empty';

?>



<!-- BEGIN SERVICE BOX -->   
<div class="row service-box margin-bottom-40">

     <div class="col-md-12 col-sm-12 load" >

     	<p>There are no items in this cart.</p>

        <?= Html::a('Continue', ['/site/index'], ['class' => 'btn btn-primary']) ?>

     </div>

</div>
<!-- END SERVICE BOX -->
