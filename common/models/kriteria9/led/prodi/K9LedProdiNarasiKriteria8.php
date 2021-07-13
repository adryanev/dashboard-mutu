<?php

namespace common\models\kriteria9\led\prodi;

use common\models\User;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "k9_led_prodi_narasi_kriteria8".
 *
 * @property int $id
 * @property int $id_led_prodi_kriteria8
 * @property string $_8_1
 * @property string $_8_2
 * @property string $_8_3
 * @property string $_8_4_a
 * @property string $_8_4_b
 * @property string $_8_5
 * @property string $_8_6
 * @property string $_8_7
 * @property string $_8_8
 * @property string $_8_9
 * @property double $progress
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 *
 * @property User $createdBy
 * @property User $updatedBy
 * @property K9LedProdiKriteria8 $ledProdiKriteria8
 */
class K9LedProdiNarasiKriteria8 extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'k9_led_prodi_narasi_kriteria8';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_led_prodi_kriteria8', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['_8_1', '_8_2', '_8_3', '_8_4_a', '_8_4_b', '_8_5', '_8_6', '_8_7', '_8_8', '_8_9'], 'string'],
            [['progress'], 'number'],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
            [['id_led_prodi_kriteria8'], 'exist', 'skipOnError' => true, 'targetClass' => K9LedProdiKriteria8::className(), 'targetAttribute' => ['id_led_prodi_kriteria8' => 'id']],
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
            'id_led_prodi_kriteria8' => 'Id Led Prodi Kriteria8',
            '_8_1' => '8.1',
            '_8_2' => '8.2',
            '_8_3' => '8.3',
            '_8_4_a' => '8.4.a',
            '_8_4_b' => '8.4.b',
            '_8_5' => '8.5',
            '_8_6' => '8.6',
            '_8_7' => '8.7',
            '_8_8' => '8.8',
            '_8_9' => '8.9',
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
    public function getLedProdiKriteria8()
    {
        return $this->hasOne(K9LedProdiKriteria8::className(), ['id' => 'id_led_prodi_kriteria8']);
    }
}
