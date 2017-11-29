<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAssetHtml;

AppAssetHtml::register($this);

?>
<?php $this->beginPage() ?>

<html>
<head>

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body >
<?php $this->beginBody() ?>

  <page size="A4">

      <?= $content ?>

  </page>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
