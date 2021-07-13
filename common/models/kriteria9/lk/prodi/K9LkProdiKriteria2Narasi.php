<?php

namespace common\models\kriteria9\lk\prodi;

use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "k9_lk_prodi_kriteria2".
 *
 * @property int $id
 * @property int $id_lk_prodi_kriteria2
 * @property string $_2_a
 * @property string $_2_b
 * @property double $progress
 * @property int $created_at
 * @property int $updated_at
 *
 * @property K9LkProdiKriteria2 $lkProdiKriteria2
 */
class K9LkProdiKriteria2Narasi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'k9_lk_prodi_kriteria2_narasi';
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
            [['id_lk_prodi_kriteria2', 'created_at', 'updated_at'], 'integer'],
            [['progress'], 'number'],
            [['_2_a', '_2_b'], 'string'],
            [
                ['id_lk_prodi_kriteria2'],
                'exist',
                'skipOnError' => true,
                'targetClass' => K9LkProdiKriteria2::className(),
                'targetAttribute' => ['id_lk_prodi_kriteria2' => 'id']
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
            'id_lk_prodi_kriteria2' => 'Id Lk Prodi',
            '_2_a' => '2.a',
            '_2_b' => '2.b',
            'progress' => 'Progress',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLkProdiKriteria2()
    {
        return $this->hasOne(K9LkProdiKriteria2::className(), ['id' => 'id_lk_prodi_kriteria2']);
    }

}
