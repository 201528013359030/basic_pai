<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sys_seqnos".
 *
 * @property string $DM
 * @property string $TABLENAME
 * @property string $FIELDNAME
 * @property integer $MAXSEQNO
 * @property string $BZ
 * @property string $QLB
 * @property string $HLB
 * @property string $DQDM
 * @property string $SFSJBS
 * @property string $SX
 * @property string $WS
 */
class SysSeqnos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sys_seqnos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['DM'], 'required'],
            [['MAXSEQNO'], 'integer'],
            [['DM', 'TABLENAME', 'FIELDNAME', 'BZ', 'QLB', 'HLB', 'DQDM', 'SFSJBS', 'SX', 'WS'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'DM' => 'Dm',
            'TABLENAME' => 'Tablename',
            'FIELDNAME' => 'Fieldname',
            'MAXSEQNO' => 'Maxseqno',
            'BZ' => 'Bz',
            'QLB' => 'Qlb',
            'HLB' => 'Hlb',
            'DQDM' => 'Dqdm',
            'SFSJBS' => 'Sfsjbs',
            'SX' => 'Sx',
            'WS' => 'Ws',
        ];
    }
}
