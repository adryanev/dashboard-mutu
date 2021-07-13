<?php

namespace common\models\kriteria9\lk\prodi;

use common\models\User;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "k9_lk_prodi_kriteria3_detail".
 *
 * @property int $id
 * @property int $id_lk_prodi_kriteria3
 * @property string $kode_dokumen
 * @property string $nama_dokumen
 * @property string $isi_dokumen
 * @property string $jenis_dokumen
 * @property string $bentuk_dokumen
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 *
 * @property K9LkProdiKriteria3 $lkProdiKriteria3
 * @property User $createdBy
 * @property User $updatedBy
 */
class K9LkProdiKriteria3Detail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'k9_lk_prodi_kriteria3_detail';
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
            [['id_lk_prodi_kriteria3', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['kode_dokumen', 'nama_dokumen', 'isi_dokumen', 'jenis_dokumen', 'bentuk_dokumen'], 'string', 'max' => 255],
            [['id_lk_prodi_kriteria3'], 'exist', 'skipOnError' => true, 'targetClass' => K9LkProdiKriteria3::className(), 'targetAttribute' => ['id_lk_prodi_kriteria3' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_lk_prodi_kriteria3' => 'Id Lk Prodi Kriteria3',
            'kode_dokumen' => 'Kode Dokumen',
            'nama_dokumen' => 'Nama Dokumen',
            'isi_dokumen' => 'Isi Dokumen',
            'jenis_dokumen' => 'Jenis Dokumen',
            'bentuk_dokumen' => 'Bentuk Dokumen',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLkProdiKriteria3()
    {
        return $this->hasOne(K9LkProdiKriteria3::className(), ['id' => 'id_lk_prodi_kriteria3']);
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

    public function afterSave($insert, $changedAttributes)
    {
        $this->lkProdiKriteria3->updateProgressDokumen()->save(false);
        $this->lkProdiKriteria3->lkProdi->updateProgress()->save(false);
        $this->lkProdiKriteria3->lkProdi->akreditasiProdi->updateProgress()->save(false);
        return parent::afterSave($insert, $changedAttributes);
    }

    public function afterDelete()
    {
        $this->lkProdiKriteria3->updateProgressDokumen()->save(false);
        $this->lkProdiKriteria3->lkProdi->updateProgress()->save(false);
        $this->lkProdiKriteria3->lkProdi->akreditasiProdi->updateProgress()->save(false);
        parent::afterDelete();
    }
}
