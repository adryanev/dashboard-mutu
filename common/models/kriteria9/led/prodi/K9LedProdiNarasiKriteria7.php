<?php

namespace common\models\kriteria9\led\prodi;

use common\models\User;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "k9_led_prodi_narasi_kriteria7".
 *
 * @property int $id
 * @property int $id_led_prodi_kriteria7
 * @property string $_7_1
 * @property string $_7_2
 * @property string $_7_3
 * @property string $_7_4_a
 * @property string $_7_4_b
 * @property string $_7_4_c
 * @property string $_7_5
 * @property string $_7_6
 * @property string $_7_7
 * @property string $_7_8
 * @property string $_7_9
 * @property double $progress
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 *
 * @property User $createdBy
 * @property User $updatedBy
 * @property K9LedProdiKriteria7 $ledProdiKriteria7
 */
class K9LedProdiNarasiKriteria7 extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'k9_led_prodi_narasi_kriteria7';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_led_prodi_kriteria7', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['_7_1', '_7_2', '_7_3', '_7_4_a', '_7_4_b', '_7_4_c', '_7_5', '_7_6', '_7_7', '_7_8', '_7_9'], 'string'],
            [['progress'], 'number'],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
            [['id_led_prodi_kriteria7'], 'exist', 'skipOnError' => true, 'targetClass' => K9LedProdiKriteria7::className(), 'targetAttribute' => ['id_led_prodi_kriteria7' => 'id']],
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
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_led_prodi_kriteria7' => 'Id Led Prodi Kriteria7',
            '_7_1' => '7.1',
            '_7_2' => '7.2',
            '_7_3' => '7.3',
            '_7_4_a' => '7.4.a',
            '_7_4_b' => '7.4.b',
            '_7_4_c' => '7.4.c',
            '_7_5' => '7.5',
            '_7_6' => '7.6',
            '_7_7' => '7.7',
            '_7_8' => '7.8',
            '_7_9' => '7.9',
            'progress' => 'Progress',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
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
    public function getLedProdiKriteria7()
    {
        return $this->hasOne(K9LedProdiKriteria7::className(), ['id' => 'id_led_prodi_kriteria7']);
    }
}
