<?php

namespace common\models\kriteria9\lk\prodi;

use common\helpers\kriteria9\K9ProdiProgressHelper;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "k9_lk_prodi_kriteria4".
 *
 * @property int $id
 * @property int $id_lk_prodi_kriteria4
 * @property double $progress
 * @property int $created_at
 * @property int $updated_at
 * @property string $_4
 *
 * @property K9LkProdiKriteria4 $lkProdiKriteria4
 *
 */
class K9LkProdiKriteria4Narasi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'k9_lk_prodi_kriteria4_narasi';
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
            [['id_lk_prodi_kriteria4', 'created_at', 'updated_at'], 'integer'],
            [['progress'], 'number'],
            [['_4'], 'string'],
            [['id_lk_prodi_kriteria4'], 'exist', 'skipOnError' => true, 'targetClass' => K9LkProdiKriteria4::className(), 'targetAttribute' => ['id_lk_prodi_kriteria4' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_lk_prodi_kriteria4' => 'Id Lk Prodi',
            '_4' => '4',
            'progress' => 'Progress',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLkProdiKriteria4()
    {
        return $this->hasOne(K9LkProdiKriteria4::className(), ['id' => 'id_lk_prodi_kriteria4']);
    }

}
