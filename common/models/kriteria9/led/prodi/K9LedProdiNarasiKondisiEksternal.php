<?php

namespace common\models\kriteria9\led\prodi;

use common\helpers\HitungNarasiLedTrait;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "k9_led_prodi_narasi_kondisi_eksternal".
 *
 * @property int $id
 * @property int|null $id_led_prodi
 * @property string|null $_A
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property double $progress
 *
 * @property K9LedProdi $ledProdi
 * @property K9LedProdiNonKriteriaDokumen $documents
 */
class K9LedProdiNarasiKondisiEksternal extends \yii\db\ActiveRecord
{

    use HitungNarasiLedTrait;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'k9_led_prodi_narasi_kondisi_eksternal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_led_prodi', 'created_at', 'updated_at'], 'integer'],
            [['_A'], 'string'],
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
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_led_prodi' => 'Id Led Prodi',
            '_A' => 'A',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'progress' => 'Progress'
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
            'A.%',
            false
        ]);
    }
}
