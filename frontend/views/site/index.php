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
                <div class="col-lg-12 col-sm-12">
                    <hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                    <h2 class="section-heading">Smart parking</h2>
                </div>
                <div class="col-lg-5 col-sm-6">
                    <p class="lead">The Smart Parking suggests the best parking lot for the destination based on users history and preferences following the rules and regulations of the parking system.<br><font size=2><b>*This System roughly follows the Texas A&M parking policies.</b></font></p>
                    
                    <p class="lead">This is written in PHP on Yii2 Framework using Postgres database including Bootstrap, Jquery, Ajax, etc.</p>
                    <p class="lead">Google Map APIs are used as well.</p>
                </div>
                <div class="col-lg-5 col-lg-offset-2 col-sm-6">
                    <img class="img-responsive" src="img/smartparking.jpg" alt="smartparking">
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
    <div class="content-section-b">

        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                    <h2 class="section-heading">Search Items from Amazon.com</h2>
                </div>
                <div class="col-lg-5 col-lg-offset-1 col-sm-push-6  col-sm-6">
                    <p class="lead">The Search Items retrieves items from Amazon.com.</p>
                    <small>* This uses AWS APIs.</small>
                </div>
                <div class="col-lg-5 col-sm-pull-6  col-sm-6">
                    <img class="img-responsive" src="img/searchitem.png" alt="smartparking">
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>    
</div>
