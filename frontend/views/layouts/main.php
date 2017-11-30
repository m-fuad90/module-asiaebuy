<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;


AppAsset::register($this);


?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body id="" onload="">
<?php $this->beginBody() ?>

    <header class="masthead text-center text-white d-flex">
        <div class="container my-auto">
        <div class="row">
          <div class="col-lg-10 mx-auto" id="tinggi">
            <h1 class="text-uppercase">
              <!-- <strong>A Big Welcome To AsiaEBuy</strong> -->
            </h1>
            <!-- <hr> -->
          </div>
          <?= $content ?>


        </div>
      </div>
    </header>



<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
