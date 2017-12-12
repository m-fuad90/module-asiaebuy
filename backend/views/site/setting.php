<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

$script = <<< JS
$(document).ready(function(){

    $('.addValidity').click(function(){
        $('.modal').modal('show')
            .find('#modelContent')
            .load($(this).attr('value'));
    });

    $('.editValidity').click(function(){
        $('.modal').modal('show')
            .find('#modelContent')
            .load($(this).attr('value'));
    });

    $('.addLead').click(function(){
        $('.modal').modal('show')
            .find('#modelContent')
            .load($(this).attr('value'));
    });

    $('.editLead').click(function(){
        $('.modal').modal('show')
            .find('#modelContent')
            .load($(this).attr('value'));
    });


    
}); 
JS;
$this->registerJs($script);

$this->title = 'Settings';
$this->params['breadcrumbs'][] = $this->title;


?>

    <section class="content-header">
      <h1>
        <?= Html::encode($this->title) ?>
        <small>Add / Update / Delete (Validity & Lead Time) </small>

      </h1>

    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-6">

                <div class="box">
                    <div class="box-header with-border">
                      <h3 class="box-title">Validity</h3>
                      <div class="pull-right">

                          <?= Html::a('ADD',FALSE, ['value'=>Url::to([
                            'lookup-validity/create',
                            ]),
                            'class' => 'btn btn-primary addValidity',
                            'id'=>'addValidity',
                            'style'=>'cursor:pointer;color:#fff;',
                            'data-target'=>'#m_modal_5',
                            'data-toggle'=>'modal'

                            ]) ?>
                      </div>

                    </div>

                    <div class="box-body">

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Info</th>
                                    <th>Date Create/Update</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php $i=0; foreach ($validity as $key_validity => $value_validity) { $i++;?>
                               <tr>
                                    <td><?= $i;?></td>
                                   <td><?= $value_validity['validity']; ?></td>
                                   <td>
                                       <ul>
                                           <li><?= empty($value_validity['date_create']) ? '' : 'Date Create : '.$value_validity['date_create']; ?></li>
                                           <li><?= empty($value_validity['date_update']) ? '' : 'Date Update : '.$value_validity['date_update']; ?></li>
                                       </ul>
                                   </td>
                                   <td>
                                        <?= Html::a('Edit',FALSE, ['value'=>Url::to([
                                        'lookup-validity/update',
                                        'id' => (string)$value_validity['_id']
                                        ]),
                                        'class' => 'btn btn-warning editValidity',
                                        'id'=>'editValidity',
                                        'style'=>'cursor:pointer;color:#fff;',
                                        'data-target'=>'#m_modal_5',
                                        'data-toggle'=>'modal'

                                        ]) ?>

                                        <?= Html::a('DELETE', [
                                        'lookup-validity/delete',
                                        'id' => (string)$value_validity['_id']

                                        ],['data-method' => 'POST','class' => 'btn btn-danger']) ?>

                                   </td>
                               </tr>

                                <?php } ?>
                            </tbody>
                            
                        </table>




                    </div>

                </div>

            </div>

            <div class="col-md-6">

                <div class="box">
                    <div class="box-header with-border">
                      <h3 class="box-title">Lead Time</h3>
                      <div class="pull-right">

                            <?= Html::a('ADD',FALSE, ['value'=>Url::to([
                            'lookup-lead-time/create',

                            ]),
                            'class' => 'btn btn-primary addLead',
                            'id'=>'addLead',
                            'style'=>'cursor:pointer;color:#fff;',
                            'data-target'=>'#m_modal_5',
                            'data-toggle'=>'modal'

                            ]) ?>
                      </div>

                    </div>

                    <div class="box-body">

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Info</th>
                                    <th>Date Create/Update</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php $i=0; foreach ($lead as $key_vlead => $value_lead) { $i++;?>
                               <tr>
                                    <td><?=$i;?></td>
                                   <td><?= $value_lead['lead_time']; ?></td>
                                   <td>
                                       <ul>
                                           <li><?= empty($value_lead['date_create']) ? '' : 'Date Create : '.$value_lead['date_create']; ?></li>
                                           <li><?= empty($value_lead['date_update']) ? '' : 'Date Update : '.$value_lead['date_update']; ?></li>
                                       </ul>
                                   </td>
                                   <td>
                                    <?= Html::a('EDIT',FALSE, ['value'=>Url::to([
                                    'lookup-lead-time/update',
                                    'id' => (string)$value_lead['_id']
                                    ]),
                                    'class' => 'btn btn-warning editLead',
                                    'id'=>'editLead',
                                    'style'=>'cursor:pointer;color:#fff;',
                                    'data-target'=>'#m_modal_5',
                                    'data-toggle'=>'modal'

                                    ]) ?>


                                    <?= Html::a('DELETE', [
                                        'lookup-lead-time/delete',
                                        'id' => (string)$value_lead['_id']

                                        ],['data-method' => 'POST','class' => 'btn btn-danger']) ?>
                                   </td>
                               </tr>

                                <?php } ?>
                            </tbody>
                            
                        </table>




                    </div>

                </div>

            </div>



        </div>
    </section>




