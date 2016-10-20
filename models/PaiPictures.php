<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pai_pictures".
 *
 * @property string $fID
 * @property string $fFileName
 * @property string $fPreviewPath
 * @property string $fDownloadPath
 * @property string $fOwner
 * @property string $fUserName
 * @property string $fCreateTime
 * @property string $fDescription
 * @property string $fTaskID
 * @property string $fThumb
 */
class PaiPictures extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pai_pictures';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fID', 'fOwner'], 'required'],
            [['fID', 'fFileName', 'fPreviewPath', 'fDownloadPath', 'fOwner', 'fUserName', 'fCreateTime', 'fDescription', 'fTaskID', 'fThumb'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'fID' => 'F ID',
            'fFileName' => 'F File Name',
            'fPreviewPath' => 'F Preview Path',
            'fDownloadPath' => 'F Download Path',
            'fOwner' => 'F Owner',
            'fUserName' => 'F User Name',
            'fCreateTime' => 'F Create Time',
            'fDescription' => 'F Description',
            'fTaskID' => 'F Task ID',
            'fThumb' => 'F Thumb',
        ];
    }
}
