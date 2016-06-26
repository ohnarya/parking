<?php
use kartik\sidenav\SideNav;
use yii\helpers\Url;
?>
<?= SideNav::widget([
    'type' => 'info',
    'encodeLabels' => false,
    'items' => [
        ['label' => 'Home', 'icon' => 'home', 'url' => Url::to(['/site/index'])],
        ['label' => 'Parking Lots', 'icon' => 'road', 'items' => [
            ['label' => 'Search Parking Lot', 'url' => Url::to(['/parkinglot/index'])],
            ['label' => 'Manage Parking Lots', 'url' => Url::to(['/parkinglot/index'])],
        ]],
        ['label' => 'Search Item', 'icon' => 'book', 'url' => Url::to(['/search/index'])],
        ['label' => 'Profile', 'icon' => 'user', 'url' => Url::to(['/site/profile'])],
    ],
]);  
?>