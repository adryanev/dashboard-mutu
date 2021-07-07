<?php

namespace common\models\kriteria9\led\prodi;

use common\models\User;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "k9_led_prodi_non_kriteria_dokumen".
 *
 * @property int $id
 * @property int|null $id_led_prodi
 * @property string|null $kode_dokumen
 * @property string|null $nama_dokumen
 * @property string|null $isi_dokumen
 * @property string|null $bentuk_dokumen
 * @property string|null $jenis_dokumen
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property K9LedProdi $ledProdi
 * @property User $createdBy
 * @property User $updatedBy
 *
 */
class K9LedProdiNonKriteriaDokumen extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'k9_led_prodi_non_kriteria_dokumen';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_led_prodi', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['isi_dokumen'], 'string'],
            [['kode_dokumen', 'nama_dokumen', 'bentuk_dokumen', 'jenis_dokumen'], 'string', 'max' => 255],
            [
                ['id_led_prodi'],
                'exist',
                'skipOnError' => true,
                'targetClass' => K9LedProdi::className(),
                'targetAttribute' => ['id_led_prodi' => 'id']
            ],
            [
                ['created_by'],
                'exist',
                'skipOnError' => true,
                'targetClass' => User::className(),
                'targetAttribute' => ['created_by' => 'id']
            ],
            [
                ['updated_by'],
                'exist',
                'skipOnError' => true,
                'targetClass' => User::className(),
                'targetAttribute' => ['updated_by' => 'id']
            ],
        ];
    }

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
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_led_prodi' => 'Id Led Prodi',
            'kode_dokumen' => 'Kode Dokumen',
            'nama_dokumen' => 'Nama Dokumen',
            'isi_dokumen' => 'Isi Dokumen',
            'bentuk_dokumen' => 'Bentuk Dokumen',
            'jenis_dokumen' => 'Jenis Dokumen',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[LedProdiController]].
     *
     * @return ActiveQuery
     */
    public function getLedProdi()
    {
        return $this->hasOne(K9LedProdi::className(), ['id' => 'id_led_prodi']);
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    /**
     * @return ActiveQuery
     */
    public function getNarasi()
    {
        $initial = substr($this->kode_dokumen, '0', '1');

        switch ($initial) {
            case 'A':
                return $this->hasOne(K9LedProdiNarasiKondisiEksternal::class, ['id_led_prodi' => 'id_led_prodi']);
            case 'B':
                return $this->hasOne(K9LedProdiNarasiProfilUpps::class, ['id_led_prodi' => 'id_led_prodi']);
            case 'D':
                return $this->hasOne(K9LedProdiNarasiAnalisis::class, ['id_led_prodi' => 'id_led_prodi']);
        }

        return new ActiveQuery($this);
    }

}
