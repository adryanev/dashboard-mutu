<?php

namespace common\models\kriteria9\lk\prodi;

use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "k9_lk_prodi_kriteria8".
 *
 * @property int $id
 * @property int $id_lk_prodi_kriteria8
 * @property string $_8_a
 * @property string $_8_b_1
 * @property string $_8_b_2
 * @property string $_8_c
 * @property string $_8_d_1
 * @property string $_8_d_2
 * @property string $_8_e_1
 * @property string $_8_e_2
 * @property string $_8_e_2__ref
 * @property string $_8_f_1
 * @property string $_8_f_2
 * @property string $_8_f_3
 * @property string $_8_f_4__1
 * @property string $_8_f_4__2
 * @property string $_8_f_4__3
 * @property string $_8_f_4__4
 * @property double $progress
 * @property int $created_at
 * @property int $updated_at
 *
 * @property K9LkProdiKriteria8 $lkProdiKriteria8
 *
 */
class K9LkProdiKriteria8Narasi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'k9_lk_prodi_kriteria8_narasi';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_lk_prodi_kriteria8', 'created_at', 'updated_at'], 'integer'],
            [['progress'], 'number'],
            [
                [
                    '_8_a',
                    '_8_b_1',
                    '_8_b_2',
                    '_8_c',
                    '_8_d_1',
                    '_8_d_2',
                    '_8_e_1',
                    '_8_e_2',
                    '_8_e_2__ref',
                    '_8_f_1',
                    '_8_f_2',
                    '_8_f_3',
                    '_8_f_4__1',
                    '_8_f_4__2',
                    '_8_f_4__3',
                    '_8_f_4__4',
                ],
                'string'
            ],

            [
                ['id_lk_prodi_kriteria8'],
                'exist',
                'skipOnError' => true,
                'targetClass' => K9LkProdiKriteria8::className(),
                'targetAttribute' => ['id_lk_prodi_kriteria8' => 'id']
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
            'id_lk_prodi_kriteria8' => 'Id Lk Prodi',
            '_8_a' => '8.a',
            '_8_b_1' => '8.b.1',
            '_8_b_2' => '8.b.2',
            '_8_c' => '8.c',
            '_8_d_1' => '8.d.1',
            '_8_d_2' => '8.d.2',
            '_8_e_1' => '8.e.1',
            '_8_e_2' => '8.e.2',
            '_8_e_2__ref' => '8.e.2-ref',
            '_8_f_1' => '8.f.1',
            '_8_f_2' => '8.f.2',
            '_8_f_3' => '8.f.3',
            '_8_f_4__1' => '8.f.4-1',
            '_8_f_4__2' => '8.f.4-2',
            '_8_f_4__3' => '8.f.4-3',
            '_8_f_4__4' => '8.f.4-4',
            'progress' => 'Progress',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLkProdiKriteria8()
    {
        return $this->hasOne(K9LkProdiKriteria8::className(), ['id' => 'id_lk_prodi_kriteria8']);
    }

}
