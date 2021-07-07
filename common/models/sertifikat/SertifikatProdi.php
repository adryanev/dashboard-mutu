<?php

namespace common\models\sertifikat;

use common\models\ProgramStudi;
use common\models\User;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "sertifikat_prodi".
 *
 * @property int $id
 * @property int $id_prodi
 * @property string $nama_lembaga
 * @property int $tgl_akreditasi
 * @property int $tgl_kadaluarsa
 * @property string $nomor_sk
 * @property string $nomor_sertifikat
 * @property int $nilai_angka
 * @property string $nilai_huruf
 * @property string $tahun_sk
 * @property int $tanggal_pengajuan
 * @property int $tanggal_diterima
 * @property int $is_publik
 * @property string $dokumen_sk
 * @property string $sertifikat
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 *
 * @property ProgramStudi $prodi
 * @property User $createdBy
 * @property User $updatedBy
 */
class SertifikatProdi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sertifikat_prodi';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            BlameableBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_prodi', 'nilai_angka',  'is_publik', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['tanggal_pengajuan', 'tanggal_diterima','tgl_akreditasi', 'tgl_kadaluarsa', 'nama_lembaga', 'nomor_sk', 'nomor_sertifikat', 'nilai_huruf', 'tahun_sk', 'dokumen_sk', 'sertifikat'], 'string', 'max' => 255],
            [['id_prodi'], 'exist', 'skipOnError' => true, 'targetClass' => ProgramStudi::className(), 'targetAttribute' => ['id_prodi' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_prodi' => 'Id Prodi',
            'nama_lembaga' => 'Nama Lembaga',
            'tgl_akreditasi' => 'Tgl Akreditasi',
            'tgl_kadaluarsa' => 'Tgl Kadaluarsa',
            'nomor_sk' => 'Nomor Sk',
            'nomor_sertifikat' => 'Nomor Sertifikat',
            'nilai_angka' => 'Nilai Angka',
            'nilai_huruf' => 'Nilai Huruf',
            'tahun_sk' => 'Tahun Sk',
            'tanggal_pengajuan' => 'Tanggal Pengajuan',
            'tanggal_diterima' => 'Tanggal Diterima',
            'is_publik' => 'Is Publik',
            'dokumen_sk' => 'Dokumen Sk',
            'sertifikat' => 'Sertifikat',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdi()
    {
        return $this->hasOne(ProgramStudi::className(), ['id' => 'id_prodi']);
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
}
