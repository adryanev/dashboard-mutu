<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "asesor_request".
 *
 * @property int $id
 * @property int $id_asesor
 * @property int|null $izinkan
 * @property int|null $id_prodi
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property ProgramStudi $prodi
 * @property User $asesor
 */
class AsesorRequest extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_asesor' => 'Id Asesor',
            'izinkan' => 'Izinkan',
            'id_prodi' => 'Id Prodi',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return string[]
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
            [['id_asesor'], 'required'],
            [['id_asesor', 'izinkan', 'id_prodi', 'created_at', 'updated_at'], 'integer'],
            [
                ['id_prodi'],
                'exist',
                'skipOnError' => true,
                'targetClass' => ProgramStudi::className(),
                'targetAttribute' => ['id_prodi' => 'id']
            ],
            [
                ['id_asesor'],
                'exist',
                'skipOnError' => true,
                'targetClass' => User::className(),
                'targetAttribute' => ['id_asesor' => 'id']
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'asesor_request';
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

    /**
     * Gets query for [[Asesor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAsesor()
    {
        return $this->hasOne(User::className(), ['id' => 'id_asesor']);
    }
}
