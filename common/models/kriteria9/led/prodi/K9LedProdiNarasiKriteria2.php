<?php

namespace common\models\kriteria9\led\prodi;

use common\models\User;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "k9_led_prodi_narasi_kriteria2".
 *
 * @property int $id
 * @property int $id_led_prodi_kriteria2
 * @property string $_2_1
 * @property string $_2_2
 * @property string $_2_3
 * @property string $_2_4_a
 * @property string $_2_4_b
 * @property string $_2_4_c
 * @property string $_2_4_d
 * @property string $_2_5
 * @property string $_2_6
 * @property string $_2_7
 * @property string $_2_8
 * @property string $_2_9
 * @property double $progress
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 *
 * @property User $createdBy
 * @property User $updatedBy
 * @property K9LedProdiKriteria2 $ledProdiKriteria2
 */
class K9LedProdiNarasiKriteria2 extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'k9_led_prodi_narasi_kriteria2';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_led_prodi_kriteria2', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['_2_1', '_2_2', '_2_3', '_2_4_a','_2_4_b','_2_4_c','_2_4_d', '_2_5', '_2_6', '_2_7', '_2_8', '_2_9'], 'string'],
            [['progress'], 'number'],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
            [['id_led_prodi_kriteria2'], 'exist', 'skipOnError' => true, 'targetClass' => K9LedProdiKriteria2::className(), 'targetAttribute' => ['id_led_prodi_kriteria2' => 'id']],
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
            'id_led_prodi_kriteria2' => 'Id Led Prodi Kriteria2',
            '_2_1' => '2.1',
            '_2_2' => '2.2',
            '_2_3' => '2.3',
            '_2_4_a' => '2.4.a',
            '_2_4_b' => '2.4.b',
            '_2_4_c' => '2.4.c',
            '_2_4_d' => '2.4.d',
            '_2_5' => '2.5',
            '_2_6' => '2.6',
            '_2_7' => '2.7',
            '_2_8' => '2.8',
            '_2_9' => '2.9',
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
    public function getLedProdiKriteria2()
    {
        return $this->hasOne(K9LedProdiKriteria2::className(), ['id' => 'id_led_prodi_kriteria2']);
    }
}
