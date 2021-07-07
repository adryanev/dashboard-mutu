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
 * This is the model class for table "k9_penilaian_prodi_kriteria".
 *
 * @property int $id
 * @property int|null $id_akreditasi_prodi
 * @property int|null $_1_4_1
 * @property int|null $_1_4_2
 * @property int|null $_1_4_3
 * @property int|null $_2_4_a_A
 * @property int|null $_2_4_a_B
 * @property int|null $_2_4_b_A
 * @property int|null $_2_4_b_B
 * @property int|null $_2_4_c_1
 * @property int|null $_2_4_c_A
 * @property int|null $_2_4_c_B
 * @property int|null $_2_5_1
 * @property int|null $_2_6_1
 * @property int|null $_2_7_1
 * @property int|null $_2_8_1
 * @property int|null $_3_4_a_1
 * @property int|null $_3_4_a_A
 * @property int|null $_3_4_a_B
 * @property int|null $_3_4_a_C
 * @property int|null $_3_4_b_1
 * @property int|null $_3_4_b_A
 * @property int|null $_3_4_b_B
 * @property int|null $_3_4_c_A
 * @property int|null $_3_4_c_B
 * @property int|null $_4_4_a_1
 * @property int|null $_4_4_a_2
 * @property int|null $_4_4_a_3
 * @property int|null $_4_4_a_4
 * @property int|null $_4_4_a_5
 * @property int|null $_4_4_a_6
 * @property int|null $_4_4_a_7
 * @property int|null $_4_4_a_8
 * @property int|null $_4_4_a_9
 * @property int|null $_4_4_b_1
 * @property int|null $_4_4_b_2
 * @property int|null $_4_4_b_3
 * @property int|null $_4_4_b_4
 * @property int|null $_4_4_b_5
 * @property int|null $_4_4_b_6
 * @property int|null $_4_4_c_1
 * @property int|null $_4_4_d_A
 * @property int|null $_4_4_d_B
 * @property int|null $_5_4_a_1
 * @property int|null $_5_4_a_2
 * @property int|null $_5_4_a_3
 * @property int|null $_5_4_a_4
 * @property int|null $_5_4_a_5
 * @property int|null $_5_4_b_1
 * @property int|null $_6_4_a_A
 * @property int|null $_6_4_a_B
 * @property int|null $_6_4_a_C
 * @property int|null $_6_4_b_1
 * @property int|null $_6_4_c_A
 * @property int|null $_6_4_c_B
 * @property int|null $_6_4_d_A
 * @property int|null $_6_4_d_B
 * @property int|null $_6_4_d_C
 * @property int|null $_6_4_d_D
 * @property int|null $_6_4_d_E
 * @property int|null $_6_4_d_1
 * @property int|null $_6_4_e_1
 * @property int|null $_6_4_f_A
 * @property int|null $_6_4_f_B
 * @property int|null $_6_4_f_C
 * @property int|null $_6_4_f_D
 * @property int|null $_6_4_f_E
 * @property int|null $_6_4_g_1
 * @property int|null $_6_4_h_1
 * @property int|null $_6_4_i_A
 * @property int|null $_6_4_i_B
 * @property int|null $_7_4_a_1
 * @property int|null $_7_4_b_1
 * @property int|null $_7_4_b_2
 * @property int|null $_8_4_a_1
 * @property int|null $_8_4_b_1
 * @property int|null $_9_4_a_1
 * @property int|null $_9_4_a_2
 * @property int|null $_9_4_a_3
 * @property int|null $_9_4_a_4
 * @property int|null $_9_4_a_5
 * @property int|null $_9_4_a_6
 * @property int|null $_9_4_a_7
 * @property int|null $_9_4_a_8
 * @property int|null $_9_4_a_9
 * @property int|null $_9_4_a_10
 * @property int|null $_9_4_a_11
 * @property int|null $_9_4_a_12
 * @property int|null $_9_4_a_13
 * @property int|null $_9_4_b_1
 * @property int|null $_9_4_b_2
 * @property int|null $_9_4_b_3
 * @property int|null $_9_4_b_4
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
class K9PenilaianProdiKriteria extends ActiveRecord
{
    use HitungPenilaianTrait;

    const STATUS_READY = 'ready';
    const STATUS_FINSIH = 'finish';

    const STATUS_PENILAIAN = [self::STATUS_READY => self::STATUS_READY, self::STATUS_FINSIH => self::STATUS_FINSIH];

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_akreditasi_prodi' => 'Id Akreditasi Prodi',
            '_1_4_1' => '1 4 1',
            '_1_4_2' => '1 4 2',
            '_1_4_3' => '1 4 3',
            '_2_4_a_A' => '2 4 a A',
            '_2_4_a_B' => '2 4 a B',
            '_2_4_b_a' => '2 4 b A',
            '_2_4_b_B' => '2 4 b B',
            '_2_4_c_1' => '2 4 c 1',
            '_2_4_c_A' => '2 4 c A',
            '_2_4_c_B' => '2 4 c B',
            '_2_5_1' => '2 5 1',
            '_2_6_1' => '2 6 1',
            '_2_7_1' => '2 7 1',
            '_2_8_1' => '2 8 1',
            '_3_4_a_1' => '3 4 A 1',
            '_3_4_a_A' => '3 4 A A',
            '_3_4_a_B' => '3 4 A B',
            '_3_4_a_C' => '3 4 A C',
            '_3_4_b_1' => '3 4 B 1',
            '_3_4_b_A' => '3 4 B A',
            '_3_4_b_B' => '3 4 B B',
            '_3_4_c_A' => '3 4 C A',
            '_3_4_c_B' => '3 4 C B',
            '_4_4_a_1' => '4 4 A 1',
            '_4_4_a_2' => '4 4 A 2',
            '_4_4_a_3' => '4 4 A 3',
            '_4_4_a_4' => '4 4 A 4',
            '_4_4_a_5' => '4 4 A 5',
            '_4_4_a_6' => '4 4 A 6',
            '_4_4_a_7' => '4 4 A 7',
            '_4_4_a_8' => '4 4 A 8',
            '_4_4_a_9' => '4 4 A 9',
            '_4_4_b_1' => '4 4 B 1',
            '_4_4_b_2' => '4 4 B 2',
            '_4_4_b_3' => '4 4 B 3',
            '_4_4_b_4' => '4 4 B 4',
            '_4_4_b_5' => '4 4 B 5',
            '_4_4_b_6' => '4 4 B 6',
            '_4_4_c_1' => '4 4 C 1',
            '_4_4_d_A' => '4 4 D A',
            '_4_4_d_B' => '4 4 D B',
            '_5_4_a_1' => '5 4 A 1',
            '_5_4_a_2' => '5 4 A 2',
            '_5_4_a_3' => '5 4 A 3',
            '_5_4_a_4' => '5 4 A 4',
            '_5_4_a_5' => '5 4 A 5',
            '_5_4_b_1' => '5 4 B 1',
            '_6_4_a_A' => '6 4 A A',
            '_6_4_a_B' => '6 4 A B',
            '_6_4_a_C' => '6 4 A C',
            '_6_4_b_1' => '6 4 B 1',
            '_6_4_c_A' => '6 4 C A',
            '_6_4_c_B' => '6 4 C B',
            '_6_4_d_A' => '6 4 D A',
            '_6_4_d_B' => '6 4 D B',
            '_6_4_d_C' => '6 4 D C',
            '_6_4_d_D' => '6 4 D D',
            '_6_4_d_E' => '6 4 D E',
            '_6_4_d_1' => '6 4 D 1',
            '_6_4_e_1' => '6 4 E 1',
            '_6_4_f_A' => '6 4 F A',
            '_6_4_f_B' => '6 4 F B',
            '_6_4_f_C' => '6 4 F C',
            '_6_4_f_D' => '6 4 F D',
            '_6_4_f_E' => '6 4 F E',
            '_6_4_g_1' => '6 4 G 1',
            '_6_4_h_1' => '6 4 H 1',
            '_6_4_i_A' => '6 4 I A',
            '_6_4_i_B' => '6 4 I B',
            '_7_4_a_1' => '7 4 A 1',
            '_7_4_b_1' => '7 4 B 1',
            '_7_4_b_2' => '7 4 B 2',
            '_8_4_a_1' => '8 4 A 1',
            '_8_4_b_1' => '8 4 B 1',
            '_9_4_a_1' => '9 4 A 1',
            '_9_4_a_2' => '9 4 A 2',
            '_9_4_a_3' => '9 4 A 3',
            '_9_4_a_4' => '9 4 A 4',
            '_9_4_a_5' => '9 4 A 5',
            '_9_4_a_6' => '9 4 A 6',
            '_9_4_a_7' => '9 4 A 7',
            '_9_4_a_8' => '9 4 A 8',
            '_9_4_a_9' => '9 4 A 9',
            '_9_4_a_10' => '9 4 A 10',
            '_9_4_a_11' => '9 4 A 11',
            '_9_4_a_12' => '9 4 A 12',
            '_9_4_a_13' => '9 4 A 13',
            '_9_4_b_1' => '9 4 B 1',
            '_9_4_b_2' => '9 4 B 2',
            '_9_4_b_3' => '9 4 B 3',
            '_9_4_b_4' => '9 4 B 4',
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
        $json = K9ProdiJsonHelper::getJsonPenilaianKriteria($this->akreditasiProdi->prodi->jenjang);

        $indikator = [];

        foreach ($json->butir as $butir1) {
            foreach ($butir1->butir as $butir2) {
                if (!empty($butir2->butir)) {
                    foreach ($butir2->butir as $butir3) {
                        foreach ($butir3->indikators as $ind) {
                            $indikator[] = $ind->nomor;
                        }
                    }
                } else {
                    foreach ($butir2->indikators as $ind) {
                        $indikator[] = $ind->nomor;
                    }
                }
            }
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
            [
                [
                    'id_akreditasi_prodi',
                    '_1_4_1',
                    '_1_4_2',
                    '_1_4_3',
                    '_2_4_a_A',
                    '_2_4_a_B',
                    '_2_4_b_A',
                    '_2_4_b_B',
                    '_2_4_c_1',
                    '_2_4_c_A',
                    '_2_4_c_B',
                    '_2_5_1',
                    '_2_6_1',
                    '_2_7_1',
                    '_2_8_1',
                    '_3_4_a_1',
                    '_3_4_a_A',
                    '_3_4_a_B',
                    '_3_4_a_C',
                    '_3_4_b_1',
                    '_3_4_b_A',
                    '_3_4_b_B',
                    '_3_4_c_A',
                    '_3_4_c_B',
                    '_4_4_a_1',
                    '_4_4_a_2',
                    '_4_4_a_3',
                    '_4_4_a_4',
                    '_4_4_a_5',
                    '_4_4_a_6',
                    '_4_4_a_7',
                    '_4_4_a_8',
                    '_4_4_a_9',
                    '_4_4_b_1',
                    '_4_4_b_2',
                    '_4_4_b_3',
                    '_4_4_b_4',
                    '_4_4_b_5',
                    '_4_4_b_6',
                    '_4_4_c_1',
                    '_4_4_d_A',
                    '_4_4_d_B',
                    '_5_4_a_1',
                    '_5_4_a_2',
                    '_5_4_a_3',
                    '_5_4_a_4',
                    '_5_4_a_5',
                    '_5_4_b_1',
                    '_6_4_a_A',
                    '_6_4_a_B',
                    '_6_4_a_C',
                    '_6_4_b_1',
                    '_6_4_c_A',
                    '_6_4_c_B',
                    '_6_4_d_A',
                    '_6_4_d_B',
                    '_6_4_d_C',
                    '_6_4_d_D',
                    '_6_4_d_1',
                    '_6_4_d_E',
                    '_6_4_e_1',
                    '_6_4_f_A',
                    '_6_4_f_B',
                    '_6_4_f_C',
                    '_6_4_f_D',
                    '_6_4_f_E',
                    '_6_4_g_1',
                    '_6_4_h_1',
                    '_6_4_i_A',
                    '_6_4_i_B',
                    '_7_4_a_1',
                    '_7_4_b_1',
                    '_7_4_b_2',
                    '_8_4_a_1',
                    '_8_4_b_1',
                    '_9_4_a_1',
                    '_9_4_a_2',
                    '_9_4_a_3',
                    '_9_4_a_4',
                    '_9_4_a_5',
                    '_9_4_a_6',
                    '_9_4_a_7',
                    '_9_4_a_8',
                    '_9_4_a_9',
                    '_9_4_a_10',
                    '_9_4_a_11',
                    '_9_4_a_12',
                    '_9_4_a_13',
                    '_9_4_b_1',
                    '_9_4_b_2',
                    '_9_4_b_3',
                    '_9_4_b_4',
                    'total',
                    'created_at',
                    'updated_at',
                    'created_by',
                    'updated_by'
                ],
                'integer'
            ],
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
    public static function tableName()
    {
        return 'k9_penilaian_prodi_kriteria';
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
