<?php
/** @var \common\models\Video */
?>

<div class="row">
    <div class="col-sm-8">
        <div class="embed-responsive embed-responsive-16by9">
            <video poster="<?php echo $model->getThumbnail() ?>"
                   class="embed-responsive-item"
                   src="<?php echo $model->getVideoLink() ?>"
                   controls></video>
        </div>
            <h6 class="mt-3"><?php echo $model->tittle ?></h6>
            <div class="d-flex justify-content-between align-items-center">
                <div><?php echo $model->getViews()->count() ?> views • <?php echo Yii::$app->formatter->asDate($model->created_at) ?></div>
                <div>
                    <button class="btn btn-sm btn-outline-primary">
                        <i class="fa-solid fa-thumbs-up"></i> 1212
                    </button>
                    <button class="btn btn-sm btn-outline-secondary">
                        <i class="fa-solid fa-thumbs-down"></i> 0
                    </button>
                </div>
            </div>
    </div>
    <div class="col-sm-4">
    </div>
</div>
