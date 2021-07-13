<?php

namespace common\models\kriteria9\led\prodi;

use common\models\kriteria9\akreditasi\K9AkreditasiProdi;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "k9_led_prodi".
 *
 * @property int $id
 * @property int $id_akreditasi_prodi
 * @property double $progress
 * @property int $created_at
 * @property int $updated_at
 *
 * @property K9AkreditasiProdi $akreditasiProdi
 * @property K9LedProdiKriteria1 $k9LedProdiKriteria1s
 * @property K9LedProdiKriteria2 $k9LedProdiKriteria2s
 * @property K9LedProdiKriteria3 $k9LedProdiKriteria3s
 * @property K9LedProdiKriteria4 $k9LedProdiKriteria4s
 * @property K9LedProdiKriteria5 $k9LedProdiKriteria5s
 * @property K9LedProdiKriteria6 $k9LedProdiKriteria6s
 * @property K9LedProdiKriteria7 $k9LedProdiKriteria7s
 * @property K9LedProdiKriteria8 $k9LedProdiKriteria8s
 * @property K9LedProdiKriteria9 $k9LedProdiKriteria9s
 *
 * @property K9LedProdiNarasiKondisiEksternal $narasiEksternal
 * @property K9LedProdiNarasiProfilUpps $narasiProfil
 * @property K9LedProdiNarasiAnalisis $narasiAnalisis
 * @property K9ProdiEksporDokumen $eksporDokumen
 */
class K9LedProdi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_akreditasi_prodi' => 'Id Akreditasi Prodi',
            'progress' => 'Progress',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_akreditasi_prodi', 'created_at', 'updated_at'], 'integer'],
            [['progress'], 'number'],
            [
                ['id_akreditasi_prodi'],
                'exist',
                'skipOnError' => true,
                'targetClass' => K9AkreditasiProdi::className(),
                'targetAttribute' => ['id_akreditasi_prodi' => 'id']
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'k9_led_prodi';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAkreditasiProdi()
    {
        return $this->hasOne(K9AkreditasiProdi::className(), ['id' => 'id_akreditasi_prodi']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getK9LedProdiKriteria1s()
    {
        return $this->hasOne(K9LedProdiKriteria1::className(), ['id_led_prodi' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getK9LedProdiKriteria2s()
    {
        return $this->hasOne(K9LedProdiKriteria2::className(), ['id_led_prodi' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getK9LedProdiKriteria3s()
    {
        return $this->hasOne(K9LedProdiKriteria3::className(), ['id_led_prodi' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getK9LedProdiKriteria4s()
    {
        return $this->hasOne(K9LedProdiKriteria4::className(), ['id_led_prodi' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getK9LedProdiKriteria5s()
    {
        return $this->hasOne(K9LedProdiKriteria5::className(), ['id_led_prodi' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getK9LedProdiKriteria6s()
    {
        return $this->hasOne(K9LedProdiKriteria6::className(), ['id_led_prodi' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getK9LedProdiKriteria7s()
    {
        return $this->hasOne(K9LedProdiKriteria7::className(), ['id_led_prodi' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getK9LedProdiKriteria8s()
    {
        return $this->hasOne(K9LedProdiKriteria8::className(), ['id_led_prodi' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getK9LedProdiKriteria9s()
    {
        return $this->hasOne(K9LedProdiKriteria9::className(), ['id_led_prodi' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEksporDokumen()
    {
        return $this->hasMany(K9ProdiEksporDokumen::className(),
            ['external_id' => 'id'])->andWhere(['type' => K9ProdiEksporDokumen::TYPE_LED]);
    }

    public function updateProgress()
    {
        $kriteria1 = $this->k9LedProdiKriteria1s->progress;
        $kriteria2 = $this->k9LedProdiKriteria2s->progress;
        $kriteria3 = $this->k9LedProdiKriteria3s->progress;
        $kriteria4 = $this->k9LedProdiKriteria4s->progress;
        $kriteria5 = $this->k9LedProdiKriteria5s->progress;
        $kriteria6 = $this->k9LedProdiKriteria6s->progress;
        $kriteria7 = $this->k9LedProdiKriteria7s->progress;
        $kriteria8 = $this->k9LedProdiKriteria8s->progress;
        $kriteria9 = $this->k9LedProdiKriteria9s->progress;

        $progressKriteria = round((($kriteria1 + $kriteria2 + $kriteria3 + $kriteria4 + $kriteria5 + $kriteria6 + $kriteria7 + $kriteria8 + $kriteria9) / 9),
            2);

        $progress = round(($this->narasiEksternal->progress + $this->narasiProfil->progress + $this->narasiAnalisis->progress + $progressKriteria) / 4,
            2);
        $this->progress = $progress;

        $this->save(false);
    }

    public function getNarasiEksternal()
    {
        return $this->hasOne(K9LedProdiNarasiKondisiEksternal::class, ['id_led_prodi' => 'id']);
    }

    public function getNarasiProfil()
    {
        return $this->hasOne(K9LedProdiNarasiProfilUpps::class, ['id_led_prodi' => 'id']);
    }

    public function getNarasiAnalisis()
    {
        return $this->hasOne(K9LedProdiNarasiAnalisis::class, ['id_led_prodi' => 'id']);
    }
}
