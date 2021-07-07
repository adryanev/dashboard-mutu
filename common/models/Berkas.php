<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "berkas".
 *
 * @property int $id
 * @property int|null $external_id
 * @property string|null $type
 * @property string|null $nama_berkas
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property DetailBerkas[] $detailBerkas
 * @property FakultasAkademi | ProgramStudi | Unit $owner
 */
class Berkas extends ActiveRecord
{
    const TYPE_PRODI = ProgramStudi::PROGRAM_STUDI;
    const TYPE_FAKULTAS = FakultasAkademi::FAKULTAS_AKADEMI;
    const TYPE_UNIT = Unit::UNIT;
    const TYPE_INSTITUSI = Constants::INSTITUSI;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'berkas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['external_id', 'created_at', 'updated_at'], 'integer'],
            [['type', 'nama_berkas'], 'string', 'max' => 255],
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
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'external_id' => 'External ID',
            'type' => 'Type',
            'nama_berkas' => 'Nama Berkas',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[DetailBerkas]].
     *
     * @return ActiveQuery
     */
    public function getDetailBerkas()
    {
        return $this->hasMany(DetailBerkas::className(), ['id_berkas' => 'id']);
    }

    /** @return ActiveQuery */
    public function getOwner()
    {
        switch ($this->type) {
            case self::TYPE_PRODI:
                return $this->getProdi();
            case self::TYPE_FAKULTAS:
                return $this->getFakultas();
            case self:: TYPE_UNIT:
                return $this->getUnit();
            default:
                return new ActiveQuery(null);
        }
    }

    /**
     * @return ActiveQuery
     */
    private function getProdi()
    {
        return $this->hasOne(ProgramStudi::class, ['id' => 'external_id']);
    }

    /**
     * @return ActiveQuery
     */
    private function getFakultas()
    {
        return $this->hasOne(FakultasAkademi::class, ['id' => 'external_id']);
    }

    private function getUnit()
    {
        return $this->hasOne(Unit::class, ['id' => 'external_id']);
    }
}
