<?php

namespace common\models\kriteria9\led\prodi;

use common\models\User;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "k9_led_prodi_kriteria2_detail".
 *
 * @property int $id
 * @property int $id_led_prodi_kriteria2
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
 * @property K9LedProdiKriteria2 $ledProdiKriteria2
 * @property User $createdBy
 * @property User $updatedBy
 */
class K9LedProdiKriteria2Detail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'k9_led_prodi_kriteria2_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            BlameableBehavior::class
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_led_prodi_kriteria2', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['kode_dokumen', 'nama_dokumen', 'isi_dokumen', 'jenis_dokumen', 'bentuk_dokumen'], 'string', 'max' => 255],
            [['id_led_prodi_kriteria2'], 'exist', 'skipOnError' => true, 'targetClass' => K9LedProdiKriteria2::className(), 'targetAttribute' => ['id_led_prodi_kriteria2' => 'id']],
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
            'id_led_prodi_kriteria2' => 'Id Led Prodi Kriteria2',
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
    public function getLedProdiKriteria2()
    {
        return $this->hasOne(K9LedProdiKriteria2::className(), ['id' => 'id_led_prodi_kriteria2']);
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
        $this->ledProdiKriteria2->updateProgress();
        $this->ledProdiKriteria2->ledProdi->updateProgress();
        $this->ledProdiKriteria2->ledProdi->akreditasiProdi->updateProgress();
        return parent::afterSave($insert, $changedAttributes);
    }

    public function afterDelete()
    {
        $this->ledProdiKriteria2->updateProgress();
        $this->ledProdiKriteria2->ledProdi->updateProgress();
        $this->ledProdiKriteria2->ledProdi->akreditasiProdi->updateProgress();
        parent::afterDelete();
    }
}
