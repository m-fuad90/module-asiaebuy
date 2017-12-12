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
	<meta name="description" content="Asiaebuy is the number one B2B online e-commerce for industrial, scientific and medical market in Southeast Asia. Asiaebuy provides customers with an efficient and cost saving purchasing experience." />
	<meta name="keywords" content= "AsiaEBuy malaysia,asiaebuy,ika,shimadzu,accutec,raxvision,mitutoyo,thermo,center,shimpo,sartorius,welch,velp,constance,milwaukee,hettich,kibron,renishaw,thinky,fisher" />

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body id="" onload="">
<?php $this->beginBody() ?>


          <?= $content ?>





<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
