<?php

namespace common\models\kriteria9\penilaian\prodi;

use common\helpers\HitungPenilaianTrait;
use common\helpers\kriteria9\K9ProdiJsonHelper;
use common\models\kriteria9\akreditasi\K9AkreditasiProdi;
use common\models\User;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "k9_penilaian_prodi_eksternal".
 *
 * @property int $id
 * @property int|null $id_akreditasi_prodi
 * @property int|null $_1
 * @property int|null $total
 * @property string|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property K9AkreditasiProdi $akreditasiProdi
 * @property User $createdBy
 * @property User $updatedBy
 */
class K9PenilaianProdiEksternal extends ActiveRecord
{

    use HitungPenilaianTrait;

    const STATUS_READY = 'ready';
    const STATUS_FINSIH = 'finish';

    const STATUS_PENILAIAN = [self::STATUS_READY => self::STATUS_READY, self::STATUS_FINSIH => self::STATUS_FINSIH];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'k9_penilaian_prodi_eksternal';
    }

    /**
     * @return array|string[]
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
            [['id_akreditasi_prodi', '_1', 'total', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['status'], 'string', 'max' => 255],
            [
                ['id_akreditasi_prodi'],
                'exist',
                'skipOnError' => true,
                'targetClass' => K9AkreditasiProdi::className(),
                'targetAttribute' => ['id_akreditasi_prodi' => 'id']
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

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_akreditasi_prodi' => 'Id Akreditasi Prodi',
            '_1' => '1',
            'total' => 'Total',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        $json = K9ProdiJsonHelper::getJsonPenilaianKondisiEksternal($this->akreditasiProdi->prodi->jenjang);

        $indikator = [];
        foreach ($json->indikators as $ind) {
            $indikator[] = $ind->nomor;
        }
        $exclude = [
            'id',
            'id_akreditasi_prodi',
            'total',
            'status',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by'
        ];

        $skor = $this->hitung($this, $exclude, $indikator);
        $this->total = $skor;
        return parent::beforeSave($insert);
    }

    /**
     * Gets query for [[AkreditasiProdi]].
     *
     * @return ActiveQuery
     */
    public function getAkreditasiProdi()
    {
        return $this->hasOne(K9AkreditasiProdi::className(), ['id' => 'id_akreditasi_prodi']);
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

}
