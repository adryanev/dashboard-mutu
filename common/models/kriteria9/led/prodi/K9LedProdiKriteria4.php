<?php

namespace common\models\kriteria9\led\prodi;

use common\helpers\kriteria9\K9ProdiProgressHelper;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "k9_led_prodi_kriteria4".
 *
 * @property int $id
 * @property int $id_led_prodi
 * @property double $progress
 * @property int $created_at
 * @property int $updated_at
 *
 * @property K9LedProdi $ledProdi
 * @property K9LedProdiKriteria4Detail[] $k9LedProdiKriteria4Details
 * @property K9LedProdiNarasiKriteria4 $k9LedProdiNarasiKriteria4s
 */
class K9LedProdiKriteria4 extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'k9_led_prodi_kriteria4';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_led_prodi', 'created_at', 'updated_at'], 'integer'],
            [['progress'], 'number'],
            [['id_led_prodi'], 'exist', 'skipOnError' => true, 'targetClass' => K9LedProdi::className(), 'targetAttribute' => ['id_led_prodi' => 'id']],
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_led_prodi' => 'Id Led Prodi',
            'progress' => 'Progress',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLedProdi()
    {
        return $this->hasOne(K9LedProdi::className(), ['id' => 'id_led_prodi']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getK9LedProdiKriteria4Details()
    {
        return $this->hasMany(K9LedProdiKriteria4Detail::className(), ['id_led_prodi_kriteria4' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getK9LedProdiNarasiKriteria4s()
    {
        return $this->hasOne(K9LedProdiNarasiKriteria4::className(), ['id_led_prodi_kriteria4' => 'id']);
    }

    public function updateProgress()
    {
        $narasi = $this->k9LedProdiNarasiKriteria4s->progress;

        $dokumen = K9ProdiProgressHelper::getDokumenLedProgress($this->id_led_prodi,$this->getK9LedProdiKriteria4Details(), 1);


        $progress = round(($narasi+$dokumen)/2,2);
        $this->progress = $progress;
        $this->save(false);
    }
}
