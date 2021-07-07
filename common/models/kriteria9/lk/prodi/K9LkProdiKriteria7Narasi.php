<?php

namespace common\models\kriteria9\lk\prodi;

use common\helpers\kriteria9\K9ProdiProgressHelper;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "k9_lk_prodi_kriteria7".
 *
 * @property int $id
 * @property int $id_lk_prodi_kriteria7
 * @property string $_7
 * @property double $progress
 * @property int $created_at
 * @property int $updated_at
 *
 * @property K9LkProdiKriteria7 $lkProdiKriteria7
 *
 */
class K9LkProdiKriteria7Narasi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'k9_lk_prodi_kriteria7_narasi';
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
            [['id_lk_prodi_kriteria7', 'created_at', 'updated_at'], 'integer'],
            [['progress'], 'number'],
            [['_7'], 'string'],
            [['id_lk_prodi_kriteria7'], 'exist', 'skipOnError' => true, 'targetClass' => K9LkProdiKriteria7::className(), 'targetAttribute' => ['id_lk_prodi_kriteria7' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_lk_prodi_kriteria7' => 'Id Lk Prodi',
            '_7' => '7',
            'progress' => 'Progress',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLkProdiKriteria7()
    {
        return $this->hasOne(K9LkProdiKriteria7::className(), ['id' => 'id_lk_prodi_kriteria7']);
    }

}
