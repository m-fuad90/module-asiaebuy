<?php


use yii\helpers\Html;
use yii\helpers\Url;
$this->title = 'AsiaEBuy';

$asiax = Url::to('@asiax');
$oc = Url::to('@oc');


?>


<div class="" style="position: absolute;right:0;bottom:0;">
      
  <p class="text-faded" style="color: black">Choose your country and start placing your orders online.</p>
  <a id="fisher" class="btn btn-primary btn-xl" onclick="setCookie('fisher')" href="<?= $asiax; ?>/fisher">Fisher Store</a>
  <a id="my" class="btn btn-primary btn-xl" onclick="setCookie('my')" href="<?= $oc;?>">Malaysia Store<span><img src="front/img/Malaysia.jpg" style="width:30px; float:right;margin-top:3px;box-shadow: 1px 1px 1px #000;" ></span></a>


</div>
