<?php

namespace common\models\kriteria9\kuantitatif\prodi;

use common\models\kriteria9\akreditasi\K9AkreditasiProdi;
use common\models\User;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "k9_data_kuantitatif_prodi".
 *
 * @property int $id
 * @property int $id_akreditasi_prodi
 * @property string $nama_dokumen
 * @property string $isi_dokumen
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 * @property string $sumber
 *
 * @property K9AkreditasiProdi $akreditasiProdi
 * @property User $createdBy
 * @property User $updatedBy
 */
class K9DataKuantitatifProdi extends \yii\db\ActiveRecord
{

    const SUMBER_EKSPOR = 'ekspor';
    const SUMBER_UNGGAH = 'unggah';

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_akreditasi_prodi' => 'Id Akreditasi Prodi',
            'nama_dokumen' => 'Nama Dokumen',
            'isi_dokumen' => 'Isi Dokumen',
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
            BlameableBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_akreditasi_prodi', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['nama_dokumen', 'isi_dokumen'], 'string', 'max' => 255],
            [
                ['id_akreditasi_prodi'],
                'exist',
                'skipOnError' => true,
                'targetClass' => K9AkreditasiProdi::className(),
                'targetAttribute' => ['id_akreditasi_prodi' => 'id']
            ],
            [
                ['created_by'],
                'exist',
                'skipOnError' => true,
                'targetClass' => User::className(),
                'targetAttribute' => ['created_by' => 'id']
            ],
            [
                ['updated_by'],
                'exist',
                'skipOnError' => true,
                'targetClass' => User::className(),
                'targetAttribute' => ['updated_by' => 'id']
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'k9_data_kuantitatif_prodi';
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
