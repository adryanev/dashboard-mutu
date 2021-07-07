<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "detail_berkas".
 *
 * @property int $id
 * @property int|null $id_berkas
 * @property string|null $isi_berkas
 * @property string|null $bentuk_berkas
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property Berkas $berkas
 */
class DetailBerkas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'detail_berkas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_berkas', 'created_at', 'updated_at'], 'integer'],
            [['isi_berkas', 'bentuk_berkas'], 'string', 'max' => 255],
            [['id_berkas'], 'exist', 'skipOnError' => true, 'targetClass' => Berkas::className(), 'targetAttribute' => ['id_berkas' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_berkas' => 'Id Berkas',
            'isi_berkas' => 'Isi Berkas',
            'bentuk_berkas' => 'Bentuk Berkas',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Berkas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBerkas()
    {
        return $this->hasOne(Berkas::className(), ['id' => 'id_berkas']);
    }
}
