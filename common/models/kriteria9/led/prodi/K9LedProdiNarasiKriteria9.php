<?php

namespace common\models\kriteria9\led\prodi;

use common\models\User;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "k9_led_prodi_narasi_kriteria9".
 *
 * @property int $id
 * @property int $id_led_prodi_kriteria9
 * @property string $_9_4_a
 * @property string $_9_4_b
 * @property string $_9_5
 * @property string $_9_6
 * @property string $_9_7
 * @property string $_9_8
 * @property string $_9_9
 * @property double $progress
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 *
 * @property User $createdBy
 * @property User $updatedBy
 * @property K9LedProdiKriteria9 $ledProdiKriteria9
 */
class K9LedProdiNarasiKriteria9 extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_led_prodi_kriteria9' => 'Id Led Prodi Kriteria9',
            '_9_4_a' => '9.4.a',
            '_9_4_b' => '9.4.b',
            '_9_5' => '9.5',
            '_9_6' => '9.6',
            '_9_7' => '9.7',
            '_9_8' => '9.8',
            '_9_9' => '9.9',
            'progress' => 'Progress',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            BlameableBehavior::class
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_led_prodi_kriteria9', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['_9_4_a', '_9_4_b', '_9_5', '_9_6', '_9_7', '_9_8', '_9_9'], 'string'],
            [['progress'], 'number'],
            [
                ['created_by'],
                'exist',
                'skipOnError' => true,
                'targetClass' => User::className(),
                'targetAttribute' => ['created_by' => 'id']
            ],
            [
                ['updated_by'],
                'exist',
                'skipOnError' => true,
                'targetClass' => User::className(),
                'targetAttribute' => ['updated_by' => 'id']
            ],
            [
                ['id_led_prodi_kriteria9'],
                'exist',
                'skipOnError' => true,
                'targetClass' => K9LedProdiKriteria9::className(),
                'targetAttribute' => ['id_led_prodi_kriteria9' => 'id']
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'k9_led_prodi_narasi_kriteria9';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLedProdiKriteria9()
    {
        return $this->hasOne(K9LedProdiKriteria9::className(), ['id' => 'id_led_prodi_kriteria9']);
    }
}
