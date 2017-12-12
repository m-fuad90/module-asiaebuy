<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use common\models\Email;

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
        <small>Information</small>

      </h1>

    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">

                <?php $i=0; foreach ($project as $key_project => $value_project) { $i++;?>

                <div class="box box-default collapsed-box">
                    <div class="box-header with-border">
                      <h3 class="box-title">#<?= $value_project['myRFQ'] ?></h3>
                      <div class="box-tools pull-right">
                          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
                      </div>


                    </div>

                    <div class="box-body">

                        <?php 

                        $email = Email::find()->where(['project_id'=>$value_project['_id']])->all();

                         ?>
          
                        <?php foreach ($email as $key_email => $value_email) { ?>

                            <div class="box box-primary box-solid">
                                <div class="box-header with-border">
                                    <h3 class="box-title">From : <?= $value_email['from_who'] ?></h3>
                                    <div class="pull-right">Date : <?= $value_email['date_mail'] ?></div>


                                </div>

                                <div class="box-body">



                                    <div class="form-group">
                                        <label>To :</label>
                                        <input type="" name="" class="form-control" disabled="disabled" value="<?php echo $value_email['to_who']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Subject :</label>
                                        <input type="" name="" class="form-control" disabled="disabled" value="<?php echo $value_email['subject']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Text :</label>
                                        <textarea class="form-control" disabled="disabled" rows="6">
                                                <?php echo strip_tags($value_email['text']); ?>
                                        </textarea>


                                    </div>

                                </div>
                            </div>

                        <?php } ?>
     




                    </div>
                </div>

                <?php } ?>



            </div>
        </div>
    </section>