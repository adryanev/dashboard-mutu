<?php

namespace common\models\kriteria9\dokumentasi\prodi;

use common\models\ProgramStudi;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "dokumentasi_prodi".
 *
 * @property int $id
 * @property int|null $id_prodi
 * @property string|null $nama_dokumen
 * @property string|null $isi_dokumen
 * @property string|null $bentuk_dokumen
 * @property string|null $komentar
 * @property int|null $is_verified
 * @property int|null $created_at
 * @property int|null $updated_at

 *
 * @property ProgramStudi $prodi
 */
class DokumentasiProdi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_prodi' => 'Id Prodi',
            'nama_dokumen' => 'Nama Dokumen',
            'isi_dokumen' => 'Isi Dokumen',
            'bentuk_dokumen' => 'Bentuk Dokumen',
            'is_verified' => 'Is Verified',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'komentar' => 'Komentar',
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
    public function rules()
    {
        return [
            [['id_prodi', 'is_verified', 'created_at', 'updated_at'], 'integer'],
            [['nama_dokumen', 'isi_dokumen', 'bentuk_dokumen','komentar'], 'string', 'max' => 255],
            [
                ['id_prodi'],
                'exist',
                'skipOnError' => true,
                'targetClass' => ProgramStudi::className(),
                'targetAttribute' => ['id_prodi' => 'id']
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dokumentasi_prodi';
    }

    /**
     * Gets query for [[Prodi]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProdi()
    {
        return $this->hasOne(ProgramStudi::className(), ['id' => 'id_prodi']);
    }
}
