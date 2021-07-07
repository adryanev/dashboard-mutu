<?php

namespace common\models;

use common\models\unit\KegiatanUnit;
use oxyaction\behaviors\RelatedPolymorphicBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "unit".
 *
 * @property int $id
 * @property string $nama
 * @property int $jenis
 * @property int $created_at
 * @property int $updated_at
 * @property string $jenisString
 * @property Profil $profil
 * @property Berkas[] $berkas
 * @property KegiatanUnit[] $kegiatans
 */
class Unit extends ActiveRecord
{
    const UNIT = 'unit';
    const JENIS_UNIT = 0;
    const JENIS_LEMBAGA = 1;
    const JENIS_SATKER = 2;

    const JENIS = [
        self::JENIS_UNIT=>'Unit',
        self::JENIS_LEMBAGA=>'Lembaga',
        self::JENIS_SATKER=>'Satuan Kerja'
    ];
    public function getJenisString()
    {
        return self::JENIS[$this->jenis];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'unit';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }



    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at','jenis'], 'integer'],
            [['nama'], 'string', 'max' => 255],
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
            'jenis'=> Yii::t('app', 'Jenis'),
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'jenisString'=> 'Jenis'
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getProfil()
    {
        return $this->hasOne(Profil::class, ['external_id'=>'id'])->andWhere(['type'=>self::UNIT]);
    }

    /**
     * @return ActiveQuery
     */
    public function getBerkas()
    {
        return $this->hasMany(Berkas::class, ['external_id'=>'id'])->andWhere(['type'=>self::UNIT]);
    }


    /**
     * @return ActiveQuery
     */
    public function getKegiatans()
    {
        return $this->hasMany(KegiatanUnit::class, ['id_unit'=>'id']);
    }
}
