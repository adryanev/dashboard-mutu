<?php

namespace common\models\kriteria9\akreditasi;

use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "k9_akreditasi".
 *
 * @property int $id
 * @property string $nama
 * @property string $tahun
 * @property string $jenis_akreditasi
 * @property string $lembaga
 * @property int $created_at
 * @property int $updated_at

 * @property K9AkreditasiProdi[] $k9AkreditasiProdis

 */
class K9Akreditasi extends \yii\db\ActiveRecord
{

    const JENIS_PRODI = 'prodi';
    const JENIS_INSTITUSI = 'institusi';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'k9_akreditasi';
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
            [['nama', 'lembaga'], 'string', 'max' => 255],
            [['tahun'], 'string', 'max' => 4],
            [['jenis_akreditasi'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
            'tahun' => 'Tahun',
            'jenis_akreditasi' => 'Jenis Akreditasi',
            'lembaga' => 'Lembaga',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getK9AkreditasiProdis()
    {
        return $this->hasMany(K9AkreditasiProdi::className(), ['id_akreditasi' => 'id']);
    }


}
