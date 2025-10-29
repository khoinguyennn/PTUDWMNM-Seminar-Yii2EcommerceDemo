<?php

/* @var $this \yii\web\View */

/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

$cartItemCount = $this->params['cartItemCount'];

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="<?= Html::encode($this->params['meta_description'] ?? 'Your trusted online shopping destination with amazing products at unbeatable prices.') ?>">
    <meta name="keywords" content="<?= Html::encode($this->params['meta_keywords'] ?? 'ecommerce, shopping, online store, products') ?>">
    <meta name="author" content="<?= Html::encode(Yii::$app->name) ?>">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="<?= Html::encode($this->title) ?>">
    <meta property="og:description" content="<?= Html::encode($this->params['meta_description'] ?? 'Your trusted online shopping destination') ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= \yii\helpers\Url::current([], true) ?>">
    <meta property="og:site_name" content="<?= Html::encode(Yii::$app->name) ?>">
    
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= Html::encode($this->title) ?>">
    <meta name="twitter:description" content="<?= Html::encode($this->params['meta_description'] ?? 'Your trusted online shopping destination') ?>">
    
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= Yii::$app->request->baseUrl ?>/favicon.ico">
    
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => '<i class="fas fa-store"></i> ' . Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-expand-lg navbar-dark bg-primary fixed-top shadow-sm',
        ],
    ]);
    $menuItems = [
        ['label' => '<i class="fas fa-home"></i> Home', 'url' => ['/site/index'], 'encode' => false],
        [
            'label' => '<i class="fas fa-shopping-cart"></i> Cart <span id="cart-quantity" class="badge badge-warning ml-1">' . $cartItemCount . '</span>',
            'url' => ['/cart/index'],
            'encode' => false,
            'options' => ['class' => 'cart-nav-item']
        ],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => '<i class="fas fa-user-plus"></i> Signup', 'url' => ['/site/signup'], 'encode' => false];
        $menuItems[] = ['label' => '<i class="fas fa-sign-in-alt"></i> Login', 'url' => ['/site/login'], 'encode' => false];
    } else {
        $menuItems[] = [
            'label' => '<i class="fas fa-user"></i> ' . (Yii::$app->user->identity->firstname ?? 'User'),
            'encode' => false,
            'items' => [
                [
                    'label' => '<i class="fas fa-user-cog"></i> Profile',
                    'url' => ['/profile/index'],
                    'encode' => false
                ],
                [
                    'label' => '<i class="fas fa-sign-out-alt"></i> Logout',
                    'url' => ['/site/logout'],
                    'linkOptions' => [
                        'data-method' => 'post'
                    ],
                    'encode' => false
                ]
            ]
        ];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav ml-auto'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer text-white mt-5">
    <div class="container py-4">
        <div class="row">
            <div class="col-md-6">
                <h5><i class="fas fa-store"></i> <?= Html::encode(Yii::$app->name) ?></h5>
                <p class="text-muted">Your trusted online shopping destination</p>
                <p class="mb-0">&copy; <?= date('Y') ?> All rights reserved.</p>
            </div>
            <div class="col-md-3">
                <h6>Quick Links</h6>
                <ul class="list-unstyled">
                    <li><a href="<?= Yii::$app->homeUrl ?>" class="text-muted"><i class="fas fa-home"></i> Home</a></li>
                    <li><a href="#" class="text-muted"><i class="fas fa-info-circle"></i> About Us</a></li>
                    <li><a href="#" class="text-muted"><i class="fas fa-envelope"></i> Contact</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h6>Follow Us</h6>
                <div class="social-links">
                    <a href="#" class="text-muted mr-3"><i class="fab fa-facebook fa-lg"></i></a>
                    <a href="#" class="text-muted mr-3"><i class="fab fa-twitter fa-lg"></i></a>
                    <a href="#" class="text-muted mr-3"><i class="fab fa-instagram fa-lg"></i></a>
                </div>
                <p class="mt-2 text-muted small">Created by <a href="https://youtube.com/TheCodeholic" target="_blank" class="text-primary">TheCodeholic</a></p>
            </div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
