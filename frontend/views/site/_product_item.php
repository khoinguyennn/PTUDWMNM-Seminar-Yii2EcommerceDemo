<?php
/**
 * User: TheCodeholic
 * Date: 12/12/2020
 * Time: 11:53 AM
 */
/** @var \common\models\Product $model */
?>
<div class="card h-100 shadow-sm product-card">
    <div class="position-relative">
        <a href="#" class="img-wrapper d-block">
            <img class="card-img-top" src="<?php echo $model->getImageUrl() ?>" alt="<?php echo $model->name ?>" loading="lazy">
        </a>
        <div class="product-overlay">
            <button class="btn btn-outline-light btn-sm quick-view">
                <i class="fas fa-eye"></i> Quick View
            </button>
        </div>
        <?php if($model->status): ?>
            <span class="badge badge-success position-absolute" style="top: 10px; left: 10px;">
                <i class="fas fa-check"></i> Available
            </span>
        <?php endif; ?>
    </div>
    
    <div class="card-body d-flex flex-column">
        <h5 class="card-title">
            <a href="#" class="text-dark text-decoration-none product-title"><?php echo \yii\helpers\StringHelper::truncateWords($model->name, 20) ?></a>
        </h5>
        
        <div class="price-section mb-2">
            <h5 class="price text-primary mb-0">
                <i class="fas fa-tag"></i>
                <?= Yii::$app->formatter->asCurrency($model->price) ?>
            </h5>
        </div>
        
        <div class="card-text text-muted flex-grow-1">
            <?php echo $model->getShortDescription() ?>
        </div>
        
        <div class="rating mb-2">
            <div class="stars">
                <i class="fas fa-star text-warning"></i>
                <i class="fas fa-star text-warning"></i>
                <i class="fas fa-star text-warning"></i>
                <i class="fas fa-star text-warning"></i>
                <i class="far fa-star text-warning"></i>
                <small class="text-muted ml-1">(4.0)</small>
            </div>
        </div>
    </div>
    
    <div class="card-footer bg-transparent border-0 pt-0">
        <div class="d-flex justify-content-between align-items-center">
            <button class="btn btn-primary btn-add-to-cart flex-grow-1 mr-2" 
                    data-url="<?php echo \yii\helpers\Url::to(['/cart/add']) ?>"
                    data-id="<?php echo $model->id ?>">
                <i class="fas fa-shopping-cart"></i> Add to Cart
            </button>
            <button class="btn btn-outline-danger btn-sm wishlist-btn" data-id="<?php echo $model->id ?>">
                <i class="far fa-heart"></i>
            </button>
        </div>
    </div>
</div>