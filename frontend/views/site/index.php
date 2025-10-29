<?php

/* @var $this yii\web\View */
/** @var \yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Welcome to ' . Yii::$app->name;
?>
<div class="site-index">
    
    <!-- Hero Section -->
    <div class="hero-section bg-primary text-white text-center py-5 mb-5 rounded">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="display-4 mb-3">
                        <i class="fas fa-shopping-bag"></i>
                        Welcome to <?= Yii::$app->name ?>
                    </h1>
                    <p class="lead mb-4">Discover amazing products at unbeatable prices. Shop now and enjoy fast delivery!</p>
                    <a href="#products" class="btn btn-warning btn-lg">
                        <i class="fas fa-arrow-down"></i> Shop Now
                    </a>
                </div>
                <div class="col-md-4">
                    <i class="fas fa-store fa-9x opacity-75"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Products Section -->
    <div class="body-content" id="products">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="section-title">
                <i class="fas fa-box text-primary"></i>
                Featured Products
            </h2>
            <div class="view-toggle">
                <button class="btn btn-outline-secondary btn-sm" id="grid-view">
                    <i class="fas fa-th"></i>
                </button>
                <button class="btn btn-outline-secondary btn-sm" id="list-view">
                    <i class="fas fa-list"></i>
                </button>
            </div>
        </div>

        <?php echo \yii\widgets\ListView::widget([
            'dataProvider' => $dataProvider,
            'layout' => '<div class="products-info mb-3">{summary}</div><div class="row products-grid" id="products-container">{items}</div><div class="d-flex justify-content-center mt-4">{pager}</div>',
            'itemView' => '_product_item',
            'itemOptions' => [
                'class' => 'col-lg-4 col-md-6 mb-4 product-item'
            ],
            'pager' => [
                'class' => \yii\bootstrap4\LinkPager::class,
                'options' => ['class' => 'pagination pagination-lg justify-content-center']
            ],
            'emptyText' => '<div class="text-center py-5">
                <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                <h4 class="text-muted">No products available</h4>
                <p class="text-muted">Check back later for amazing deals!</p>
            </div>'
        ]) ?>

    </div>
</div>
