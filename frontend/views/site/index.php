<?php
namespace frontend\views\site;
use frontend\assets\FrontAsset;
/* @var $this yii\web\View */

$this->title = 'Jiyoung\' Portpolio';
?>
<?php FrontAsset::register($this); ?>
<div class="site-index">

    <div class="intro-header">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <div class="intro-message">
                        <h1><span>Jiyoung Hwang</span></h1>
                        <hr class='hightlighted-word'>
                        <ul class="list-inline intro-social-buttons">
                            <li>
                                <a href="https://github.com/ohnarya" class="btn btn-default btn-lg"><i class="fa fa-github fa-fw"></i> <span class="network-name">Github</span></a>
                            </li>
                            <li>
                                <a href="https://www.linkedin.com/in/jiyoung-hwang-241545b4" class="btn btn-default btn-lg"><i class="fa fa-linkedin fa-fw"></i> <span class="network-name">Linkedin</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
    <!-- /.intro-header -->

    <div class="content-section-a">

        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-sm-6">
                    <hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                    <h2 class="section-heading">Smart parking:</h2>
                    <p class="lead">The Smart Parking suggests the best parking lot for the destination based on users history and preferences following the rules and regulations of the parking system.</p>
                    <small>* This System roughly follows the Texas A&M parking policies.</small>
                </div>
                <div class="col-lg-5 col-lg-offset-2 col-sm-6">
                    <img class="img-responsive" src="../web/img/smartparking.jpg" alt="smartparking">
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
</div>
