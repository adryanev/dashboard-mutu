<?php

namespace common\models\kriteria9\lk\prodi;

use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "k9_lk_prodi_kriteria6".
 *
 * @property int $id
 * @property int $id_lk_prodi_kriteria6
 * @property string $_6_a
 * @property string $_6_b
 * @property double $progress
 * @property int $created_at
 * @property int $updated_at
 *
 * @property K9LkProdiKriteria6 $lkProdiKriteria6
 *
 */
class K9LkProdiKriteria6Narasi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'k9_lk_prodi_kriteria6_narasi';
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
            [['id_lk_prodi_kriteria6', 'created_at', 'updated_at'], 'integer'],
            [['progress'], 'number'],
            [['_6_a', '_6_b'], 'string'],
            [
                ['id_lk_prodi_kriteria6'],
                'exist',
                'skipOnError' => true,
                'targetClass' => K9LkProdiKriteria6::className(),
                'targetAttribute' => ['id_lk_prodi_kriteria6' => 'id']
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
            'id_lk_prodi_kriteria6' => 'Id Lk Prodi',
            '_6_a' => '6.a',
            '_6_b' => '6.b',
            'progress' => 'Progress',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLkProdiKriteria6()
    {
        return $this->hasOne(K9LkProdiKriteria6::className(), ['id' => 'id_lk_prodi_kriteria6']);
    }

}
