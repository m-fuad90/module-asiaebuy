<?php


use yii\helpers\Html;
use yii\helpers\Url;
$this->title = 'AsiaEBuy';

$asiax = Url::to('@asiax');
$oc = Url::to('@oc');


?>

  <div class="container my-auto">
    <div class="row">
      <div class="col-lg-10 mx-auto">
        <h1 class="text-uppercase">
          <strong>A Big Welcome To AsiaEBuy</strong>
        </h1>
        <hr>
      </div>
      <div class="col-xs-12 col-md-12  mx-auto">
      		
        <p class="text-faded mb-5">Choose your country and start placing your orders online.</p>
        <a id="fisher" class="btn btn-primary btn-xl" onclick="setCookie('fisher')" href="<?= $asiax; ?>/fisher">Fisher <span style="display: none" class="fisherstore">Store</span></a>
        <a id="my" class="btn btn-primary btn-xl" onclick="setCookie('my')" href="<?= $oc;?>">Malaysia <span style="display: none" class="mystore">Store</span> <span><img src="front/img/Malaysia.jpg" style="width:30px; float:right;margin-top:3px;box-shadow: 1px 1px 1px #000;" ></span></a>

        <!-- <select class="js-example-basic-single" id='social' style="padding:25px !important;">
  				 <option value=''>Choose Your Country</option>
  				 <option value='Malaysia'>Malaysia</option>
  				 <option value='twitter'>Twitter</option>
  				 <option value='linkedin'>Linkedin</option>
  				 <option value='google_plus'>Google Plus</option>
  				 <option value='vimeo'>Vimeo</option>
  			</select> -->
      </div>
    </div>
  </div>

