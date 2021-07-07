<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "profil_user_role".
 *
 * @property int $id
 * @property int|null $id_profil
 * @property int|null $external_id
 * @property string|null $type
 *
 * @property ProfilUser $profil
 */
class ProfilUserRole extends \yii\db\ActiveRecord
{
    const TIPE_PRODI = ProgramStudi::PROGRAM_STUDI;
    const TIPE_UNIT = Unit::UNIT;
    const TIPE_FAKULTAS = FakultasAkademi::FAKULTAS_AKADEMI;

    const TIPE = [
        self::TIPE_PRODI=>'Program Studi',
        self::TIPE_FAKULTAS=>'Fakultas / Akademi / Pascasarjana',
        self::TIPE_UNIT=>'Unit / Lembaga / Satuan Kerja'
    ];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profil_user_role';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_profil', 'external_id'], 'integer'],
            [['type'], 'string', 'max' => 10],
            [['id_profil'], 'exist', 'skipOnError' => true, 'targetClass' => ProfilUser::className(), 'targetAttribute' => ['id_profil' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_profil' => 'Id Profil',
            'external_id' => 'External ID',
            'type' => 'Type',
        ];
    }

    /**
     * Gets query for [[Profil]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfil()
    {
        return $this->hasOne(ProfilUser::className(), ['id' => 'id_profil']);
    }
}
