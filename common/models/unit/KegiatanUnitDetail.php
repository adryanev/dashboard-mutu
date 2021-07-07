<?php

namespace common\models\unit;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "kegiatan_unit_detail".
 *
 * @property int $id
 * @property int $id_kegiatan_unit
 * @property string $nama_file
 * @property string $isi_file
 * @property string $bentuk_file
 * @property string $jenis_file
 * @property int $created_at
 * @property int $updated_at
 *
 * @property KegiatanUnit $kegiatanUnit
 */
class KegiatanUnitDetail extends \yii\db\ActiveRecord
{

    const JENIS_SK_KEGIATAN = 'sk_kegiatan';
    const JENIS_ABSENSI = 'absensi';
    const JENIS_LAPORAN_KEGIATAN = 'laporan_kegiatan';
    const JENIS_FOTO_KEGIATAN = 'foto_kegiatan';
    const JENIS_SERTIFIKAT = 'sertifikat';
    const JENIS_DOKUMEN_LAINNYA = 'dokumen_lainnya';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kegiatan_unit_detail';
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
    public function rules()
    {
        return [
            [['id_kegiatan_unit', 'created_at', 'updated_at'], 'integer'],
            [['nama_file','bentuk_file'], 'string', 'max' => 255],
            [['id_kegiatan_unit'], 'exist', 'skipOnError' => true, 'targetClass' => KegiatanUnit::className(), 'targetAttribute' => ['id_kegiatan_unit' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_kegiatan_unit' => 'Id Kegiatan Unit',
            'nama_file' => 'Nama File',
            'bentuk_file' => 'Bentuk File',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKegiatanUnit()
    {
        return $this->hasOne(KegiatanUnit::className(), ['id' => 'id_kegiatan_unit']);
    }
}
