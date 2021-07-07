<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "profil_user".
 *
 * @property int $id
 * @property int $id_user
 * @property string $nama_lengkap
 * @property int $created_at
 * @property int $updated_at
 *
 * @property ProgramStudi $prodi
 * @property FakultasAkademi $fakultas
 * @property User $user
 * @property ProfilUserRole $profilUserRole
 *
 * @property Unit $unit
 */
class ProfilUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profil_user';
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
            [['id_user', 'id_prodi', 'id_fakultas', 'created_at', 'updated_at'], 'integer'],
            [['nama_lengkap'], 'string', 'max' => 255],
            [['id_prodi'], 'exist', 'skipOnError' => true, 'targetClass' => ProgramStudi::className(), 'targetAttribute' => ['id_prodi' => 'id']],
            [['id_fakultas'], 'exist', 'skipOnError' => true, 'targetClass' => FakultasAkademi::className(), 'targetAttribute' => ['id_prodi' => 'id']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id User',
            'nama_lengkap' => 'Nama Lengkap',
            'id_prodi' => 'Program Studi',
            'id_fakultas' => 'Fakultas',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdi()
    {

        return $this->hasOne(ProgramStudi::className(), ['id' => 'external_id'])->viaTable(ProfilUserRole::tableName(),['id_profil'=>'id'],function ($query){
            $query->andWhere(['type'=>ProfilUserRole::TIPE_PRODI]);
        });
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFakultas()
    {
        return $this->hasOne(FakultasAkademi::className(), ['id' => 'external_id'])->viaTable(ProfilUserRole::tableName(),['id_profil'=>'id'],function ($query){
            $query->andWhere(['type'=>ProfilUserRole::TIPE_FAKULTAS]);
        });
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnit(){
        return $this->hasOne(Unit::class,['id'=>'external_id'])->viaTable(ProfilUserRole::tableName(),['id_profil'=>'id'], function($query){
            $query->andWhere(['type'=>ProfilUserRole::TIPE_UNIT]);
        });
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfilUserRole(){
        return $this->hasOne(ProfilUserRole::class,['id_profil'=>'id']);
    }
}
