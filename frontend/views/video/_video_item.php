<?php
/** @var $model \common\models\Video */
?>

<div class="card m-3" style="width: 14rem;">
    <div class="embed-responsive embed-responsive-16by9">
        <video poster="<?php echo $model->getThumbnail() ?>" class="embed-responsive-item" src="<?php echo $model->getVideoLink() ?>"></video>
    </div>
    <div class="card-body p-2">
        <h5 class="card-title m-0"><?php echo $model->tittle ?></h5>
        <p class="text-muted card-text m-0"><?php echo $model->createdBy->username ?></p>
        <p class="text-muted card-text m-0">120 views . <?php echo Yii::$app->formatter->asRelativeTime($model->created_at) ?></p>
    </div>
</div>
