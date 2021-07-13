<?php

namespace common\models\kriteria9\led\prodi;

use common\helpers\HitungNarasiLedTrait;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "k9_led_prodi_narasi_analisis".
 *
 * @property int $id
 * @property int|null $id_led_prodi
 * @property string|null $_1
 * @property string|null $_2
 * @property string|null $_3
 * @property string|null $_4
 * @property double $progress
 * @property int $created_at
 * @property int $updated_at
 *
 * @property K9LedProdi $ledProdi
 * @property K9LedProdiNonKriteriaDokumen $documents
 */
class K9LedProdiNarasiAnalisis extends \yii\db\ActiveRecord
{

    use HitungNarasiLedTrait;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'k9_led_prodi_narasi_analisis';
    }

    /**
     * @return array|string[]
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
            [['id_led_prodi', 'created_at', 'updated_at'], 'integer'],
            [['_1', '_2', '_3', '_4'], 'string'],
            [['progress'], 'double'],
            [
                ['id_led_prodi'],
                'exist',
                'skipOnError' => true,
                'targetClass' => K9LedProdi::className(),
                'targetAttribute' => ['id_led_prodi' => 'id']
            ],
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
            '_1' => '1',
            '_2' => '2',
            '_3' => '3',
            '_4' => '4',
        ];
    }


    /**
     * Gets query for [[LedProdiController]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLedProdi()
    {
        return $this->hasOne(K9LedProdi::className(), ['id' => 'id_led_prodi']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocuments()
    {
        return $this->hasMany(K9LedProdiNonKriteriaDokumen::class, ['id_led_prodi' => 'id_led_prodi'])->andWhere([
            'like',
            'kode_dokumen',
            'D%'
        ]);
    }
}
