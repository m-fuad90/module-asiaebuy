<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

$script = <<< JS
$(document).ready(function(){



    
}); 
JS;
$this->registerJs($script);

$this->title = 'Email';
$this->params['breadcrumbs'][] = $this->title;


?>

    <section class="content-header">
      <h1>
        <?= Html::encode($this->title) ?>

      </h1>

    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">

                <?php $i=0; foreach ($email as $key_email => $value_email) { $i++;?>

                <div class="box">
                    <div class="box-header with-border">
                      <h3 class="box-title">Subject : <?= $value_email['subject'] ?></h3>
                      <div class="pull-right"></div>


                    </div>

                    <div class="box-body">




                    </div>
                </div>

                <?php } ?>



            </div>
        </div>
    </section>