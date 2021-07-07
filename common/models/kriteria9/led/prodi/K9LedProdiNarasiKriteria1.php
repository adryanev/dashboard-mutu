<?php

namespace common\models\kriteria9\led\prodi;

use common\models\User;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "k9_led_prodi_narasi_kriteria1".
 *
 * @property int $id
 * @property int $id_led_prodi_kriteria1
 * @property string $_1_1
 * @property string $_1_2
 * @property string $_1_3
 * @property string $_1_4
 * @property string $_1_5
 * @property string $_1_6
 * @property string $_1_7
 * @property string $_1_8
 * @property string $_1_9
 * @property double $progress
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 *
 * @property User $createdBy
 * @property User $updatedBy
 * @property K9LedProdiKriteria1 $ledProdiKriteria1
 */
class K9LedProdiNarasiKriteria1 extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'k9_led_prodi_narasi_kriteria1';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_led_prodi_kriteria1', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['_1_1', '_1_2', '_1_3', '_1_4', '_1_5', '_1_6', '_1_7', '_1_8', '_1_9'], 'string'],
            [['progress'], 'number'],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
            [['id_led_prodi_kriteria1'], 'exist', 'skipOnError' => true, 'targetClass' => K9LedProdiKriteria1::className(), 'targetAttribute' => ['id_led_prodi_kriteria1' => 'id']],
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
            'id_led_prodi_kriteria1' => 'Id Led Prodi Kriteria1',
            '_1_1' => '1.1',
            '_1_2' => '1.2',
            '_1_3' => '1.3',
            '_1_4' => '1.4',
            '_1_5' => '1.5',
            '_1_6' => '1.6',
            '_1_7' => '1.7',
            '_1_8' => '1.8',
            '_1_9' => '1.9',
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
    public function getLedProdiKriteria1()
    {
        return $this->hasOne(K9LedProdiKriteria1::className(), ['id' => 'id_led_prodi_kriteria1']);
    }
}
