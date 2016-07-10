<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use kartik\sidenav\SideNav;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title>Hwang, Jiyoung</title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Hwang, Jiyoung',
        'brandUrl' => Yii::$app->homeUrl,
        'renderInnerContainer' => false,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);

    // set the menu according to the roles of the login-user    
    $parkingSubmemuItems = [ 
               ['label'=>'Search Parking Lot', 'url' => Url::to(['/parkinglot/search'])],
            ]; 

    if (\Yii::$app->user->can('manageParkingLots')) {
        array_push($parkingSubmemuItems,['label'=>'Manage Parking Lots', 'url' => Url::to(['/parkinglot/index'])
                                        ]);
    }
    if (\Yii::$app->user->can('manageDestinations')) {
        array_push($parkingSubmemuItems,['label'=>'Manage Destinations', 'url' => Url::to(['/destination/index'])
                                        ]);
    }
    
    
    if (\Yii::$app->user->can('settingMyAccount')) {
        array_push($parkingSubmemuItems,['label'=>'Setting My Account', 'url' => Url::to(['/site/setting'])
                                        ]);
    }
    
    $leftItems = [
        ['label' => 'Parking Lot', 'items'=> $parkingSubmemuItems],
        ['label' => 'Search Item', 'url' => ['/search/index']],
    ];
    
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left'],
        'items' => $leftItems,
    ]);  
    if (Yii::$app->user->isGuest) {
        $rightItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $rightItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $rightItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link']
            )
            . Html::endForm()
            . '</li>';
    }
    
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right padding-md-horizontal'],
        'items' => $rightItems,
    ]);
    NavBar::end();
    ?>

    <div class="container-fluid">
        <div class="col-md-12 no-padding">
            <div class="alert"><?= Alert::widget() ?></div>
            <div class="breadcrumbs">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            </div>
            <?= $content ?>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Hwang, Jiyoung <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
