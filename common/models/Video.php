<?php

namespace common\models;

use common\models\query\VideoQuery;
use Yii;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "{{%video}}".
 *
 * @property string $video_id
 * @property string $tittle
 * @property string|null $description
 * @property string|null $tags
 * @property int|null $status
 * @property int|null $has_thumbnail
 * @property string|null $video_name
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 *
 * @property User $createdBy
 */
class Video extends \yii\db\ActiveRecord
{
    /**
     * @var \yii\web\UploadedFile
     */

    public $video;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%video}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['video_id', 'tittle'], 'required'],
            [['description'], 'string'],
            [['status', 'has_thumbnail', 'created_at', 'updated_at', 'created_by'], 'integer'],
            [['video_id'], 'string', 'max' => 16],
            [['tittle', 'tags', 'video_name'], 'string', 'max' => 512],
            [['video_id'], 'unique'],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'video_id' => 'Video ID',
            'tittle' => 'Tittle',
            'description' => 'Description',
            'tags' => 'Tags',
            'status' => 'Status',
            'has_thumbnail' => 'Has Thumbnail',
            'video_name' => 'Video Name',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    /**
     * {@inheritdoc}
     * @return VideoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VideoQuery(get_called_class());
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        $isInsert=$this->isNewRecord;
        if($isInsert){
            $this->video_id=Yii::$app->security->generateRandomString(8);
            $this->tittle=$this->video->name;
            $this->video_name=$this->video->name;
        }
        $save = parent::save($runValidation, $attributeNames);
        if(!$save){
            return false;
        }
        if($isInsert){
            $videoPath=Yii::getAlias('@frontend/web/storage/videos/'.$this->video_id.'.mp4');
            if(!is_dir(dirname($videoPath))){
                FileHelper::createDirectory(dirname($videoPath));
            }
            $this->video->saveAs($videoPath);
        }
        return true;
    }
}
