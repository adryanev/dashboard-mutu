<?php

namespace common\models\unit;

use common\models\Unit;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "kegiatan_unit".
 *
 * @property int $id
 * @property int $id_unit
 * @property string $nama
 * @property string $deskripsi
 * @property int $waktu_mulai
 * @property int $waktu_selesai
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Unit $unit
 * @property KegiatanUnitDetail[] $kegiatanUnitDetails
 */
class KegiatanUnit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kegiatan_unit';
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
            [['id_unit', 'waktu_mulai', 'waktu_selesai', 'created_at', 'updated_at'], 'integer'],
            [['deskripsi'], 'string'],
            [['nama'], 'string', 'max' => 255],
            [['id_unit'], 'exist', 'skipOnError' => true, 'targetClass' => Unit::className(), 'targetAttribute' => ['id_unit' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_unit' => 'Id Unit',
            'nama' => 'Nama',
            'deskripsi' => 'Deskripsi',
            'waktu_mulai' => 'Waktu Mulai',
            'waktu_selesai' => 'Waktu Selesai',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnit()
    {
        return $this->hasOne(Unit::className(), ['id' => 'id_unit']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKegiatanUnitDetails()
    {
        return $this->hasMany(KegiatanUnitDetail::className(), ['id_kegiatan_unit' => 'id']);
    }
}
