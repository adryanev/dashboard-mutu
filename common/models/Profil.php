<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "profil".
 *
 * @property int $id
 * @property int $external_id
 * @property string $type
 * @property string $visi
 * @property string $misi
 * @property string $tujuan
 * @property string $sasaran
 * @property string $motto
 * @property string $sambutan
 * @property string $struktur_organisasi
 * @property int $created_at
 * @property int $updated_at
 *
 * @property ProgramStudi | Unit | FakultasAkademi $owner
 *
 */
class Profil extends \yii\db\ActiveRecord
{
    const TIPE_PRODI = ProgramStudi::PROGRAM_STUDI;
    const TIPE_UNIT = Unit::UNIT;
    const TIPE_FAKULTAS = FakultasAkademi::FAKULTAS_AKADEMI;
    const TIPE_INSTITUSI = Constants::INSTITUSI;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profil';
    }

    public function behaviors()
    {
        return [TimestampBehavior::class];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['external_id', 'created_at', 'updated_at'], 'integer'],
            [['sambutan'], 'string'],
            [['type', 'visi', 'misi', 'tujuan', 'sasaran', 'motto'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'external_id' => 'Id Foreign Key',
            'type' => 'Tipe',
            'visi' => 'Visi',
            'misi' => 'Misi',
            'tujuan' => 'Tujuan',
            'sasaran' => 'Sasaran',
            'motto' => 'Motto',
            'sambutan' => 'Sambutan',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getOwner()
    {
        switch ($this->type) {
            case self::TIPE_UNIT :
                return $this->hasOne(Unit::class, ['id'=>'external_id']);
            case self::TIPE_FAKULTAS:
                return $this->hasOne(FakultasAkademi::class, ['id'=>'external_id']);
            case self::TIPE_PRODI :
                return $this->hasOne(ProgramStudi::class, ['id'=>'external_id']);
            default:
                return new ActiveQuery(null);
        }
    }
}
