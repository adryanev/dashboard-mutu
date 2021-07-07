<?php

namespace common\models\kriteria9\led\prodi;

use common\helpers\HitungNarasiLedTrait;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "k9_led_prodi_narasi_profil_upps".
 *
 * @property int $id
 * @property int|null $id_led_prodi
 * @property string|null $_1
 * @property string|null $_2
 * @property string|null $_3
 * @property string|null $_4
 * @property string|null $_5
 * @property string|null $_6
 * @property string|null $_7
 * @property string|null $_8
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property double $progress
 *
 * @property K9LedProdi $ledProdi
 * @property K9LedProdiNonKriteriaDokumen[] $documents
 */
class K9LedProdiNarasiProfilUpps extends \yii\db\ActiveRecord
{

    use HitungNarasiLedTrait;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'k9_led_prodi_narasi_profil_upps';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_led_prodi', 'created_at', 'updated_at'], 'integer'],
            [['progress'], 'double'],
            [['_1', '_2', '_3', '_4', '_5', '_6', '_7', '_8'], 'string'],
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
            '_1' => '1',
            '_2' => '2',
            '_3' => '3',
            '_4' => '4',
            '_5' => '5',
            '_6' => '6',
            '_7' => '7',
            '_8' => '8',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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
            'B%'
        ]);
    }
}
