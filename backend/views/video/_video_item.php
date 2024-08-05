<?php
/** @var $model \common\models\Video */

use \yii\helpers\StringHelper;
?>

<div class="media">
    <div class="embed-responsive embed-responsive-16by9 mr-3"
         style="width: 140px;">
        <video poster="<?php echo $model->getThumbnail() ?>" class="embed-responsive-item" src="<?php echo $model->getVideoLink() ?>"></video>
    </div>
    <div class="media-body">
        <h6 class="mt-0"><?php echo $model->tittle ?></h6>
        <?php echo StringHelper::truncateWords($model->description,10) ?>
    </div>
</div>