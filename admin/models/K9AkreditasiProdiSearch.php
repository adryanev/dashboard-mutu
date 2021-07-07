<?php

namespace admin\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\kriteria9\akreditasi\K9AkreditasiProdi;

/**
 * K9AkreditasiProdiSearch represents the model behind the search form of `common\models\kriteria9\akreditasi\K9AkreditasiProdi`.
 */
class K9AkreditasiProdiSearch extends K9AkreditasiProdi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_akreditasi', 'id_prodi', 'created_at', 'updated_at'], 'integer'],
            [['progress'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = K9AkreditasiProdi::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_akreditasi' => $this->id_akreditasi,
            'id_prodi' => $this->id_prodi,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'progress' => $this->progress,
        ]);

        return $dataProvider;
    }
}
