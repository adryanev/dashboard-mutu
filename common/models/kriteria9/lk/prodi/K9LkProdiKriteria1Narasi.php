<?php

namespace common\models\kriteria9\lk\prodi;

use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "k9_lk_prodi_kriteria1".
 *
 * @property int $id
 * @property int $id_lk_prodi_kriteria1
 * @property double $progress
 * @property int $created_at
 * @property int $updated_at
 *
 * @property K9LkProdiKriteria1 $lkProdiKriteria1
 * @property string $_1__1
 * @property string $_1__2
 * @property string $_1__3
 */
class K9LkProdiKriteria1Narasi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'k9_lk_prodi_kriteria1_narasi';
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
            [['id_lk_prodi_kriteria1', 'created_at', 'updated_at'], 'integer'],
            [['progress'], 'number'],
            [['_1__1', '_1__2', '_1__3'], 'string'],
            [
                ['id_lk_prodi_kriteria1'],
                'exist',
                'skipOnError' => true,
                'targetClass' => K9LkProdiKriteria1::className(),
                'targetAttribute' => ['id_lk_prodi_kriteria1' => 'id']
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
            'id_lk_prodi_kriteria1' => 'Id Lk Prodi Kriteria 1',
            '_1__1' => '1-1',
            '_1__2' => '1-2',
            '_1__3' => '1-3',
            'progress' => 'Progress',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLkProdiKriteria1()
    {
        return $this->hasOne(K9LkProdiKriteria1::className(), ['id' => 'id_lk_prodi_kriteria1']);
    }
}
