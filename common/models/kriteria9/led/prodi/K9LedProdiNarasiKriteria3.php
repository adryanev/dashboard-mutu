<?php

namespace common\models\kriteria9\led\prodi;

use common\models\User;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "k9_led_prodi_narasi_kriteria3".
 *
 * @property int $id
 * @property int $id_led_prodi_kriteria3
 * @property string $_3_1
 * @property string $_3_2
 * @property string $_3_3
 * @property string $_3_4_a
 * @property string $_3_4_b
 * @property string $_3_4_c
 * @property string $_3_5
 * @property string $_3_6
 * @property string $_3_7
 * @property string $_3_8
 * @property string $_3_9
 * @property double $progress
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 *
 * @property User $createdBy
 * @property User $updatedBy
 * @property K9LedProdiKriteria3 $ledProdiKriteria3
 */
class K9LedProdiNarasiKriteria3 extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'k9_led_prodi_narasi_kriteria3';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_led_prodi_kriteria3', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['_3_1', '_3_2', '_3_3', '_3_4_a', '_3_4_b', '_3_4_c', '_3_5', '_3_6', '_3_7', '_3_8', '_3_9'], 'string'],
            [['progress'], 'number'],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
            [['id_led_prodi_kriteria3'], 'exist', 'skipOnError' => true, 'targetClass' => K9LedProdiKriteria3::className(), 'targetAttribute' => ['id_led_prodi_kriteria3' => 'id']],
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
            'id_led_prodi_kriteria3' => 'Id Led Prodi Kriteria3',
            '_3_1' => '3.1',
            '_3_2' => '3.2',
            '_3_3' => '3.3',
            '_3_4_a' => '3.4.a',
            '_3_4_b' => '3.4.b',
            '_3_4_c' => '3.4.c',
            '_3_5' => '3.5',
            '_3_6' => '3.6',
            '_3_7' => '3.7',
            '_3_8' => '3.8',
            '_3_9' => '3.9',
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
    public function getLedProdiKriteria3()
    {
        return $this->hasOne(K9LedProdiKriteria3::className(), ['id' => 'id_led_prodi_kriteria3']);
    }
}
