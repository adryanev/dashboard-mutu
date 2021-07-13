<?php

namespace common\models\kriteria9\led\prodi;

use common\models\kriteria9\lk\prodi\K9LkProdi;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "k9_dokumen_led_prodi".
 *
 * @property int $id
 * @property int $external_id
 * @property string $type
 * @property string $nama_dokumen
 * @property string $bentuk_dokumen
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 * @property string kode_dokumen
 *
 * @property K9LedProdi $ledProdi
 * @property K9LkProdi $lkProdi
 */
class K9ProdiEksporDokumen extends \yii\db\ActiveRecord
{

    const TYPE_LED = 'led';
    const TYPE_LK = 'lk';

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'external_id' => 'ID External',
            'type' => 'Tipe',
            'nama_dokumen' => 'Nama Dokumen',
            'bentuk_dokumen' => 'Bentuk Dokumen',
            'kode_dokumen' => 'Kode Dokumen',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

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
    public function rules()
    {
        return [
            [['external_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['nama_dokumen', 'bentuk_dokumen', 'kode_dokumen', 'type'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'k9_prodi_ekspor_dokumen';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLedProdi()
    {
        return $this->hasOne(K9LedProdi::className(),
            ['id' => 'external_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLkProdi()
    {
        return $this->hasOne(K9LkProdi::className(),
            ['id' => 'external_id']);
    }
}
