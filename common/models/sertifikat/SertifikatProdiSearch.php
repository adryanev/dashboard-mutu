<?php

namespace common\models\sertifikat;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\sertifikat\SertifikatProdi;

/**
 * SertifikatProdiSearch represents the model behind the search form of `common\models\sertifikat\SertifikatProdi`.
 */
class SertifikatProdiSearch extends SertifikatProdi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_prodi', 'tgl_akreditasi', 'tgl_kadaluarsa', 'nilai_angka', 'tanggal_pengajuan', 'tanggal_diterima', 'is_publik', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['nama_lembaga', 'nomor_sk', 'nomor_sertifikat', 'nilai_huruf', 'tahun_sk', 'dokumen_sk', 'sertifikat'], 'safe'],
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
        $query = SertifikatProdi::find();

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
            'id_prodi' => $this->id_prodi,
            'tgl_akreditasi' => $this->tgl_akreditasi,
            'tgl_kadaluarsa' => $this->tgl_kadaluarsa,
            'nilai_angka' => $this->nilai_angka,
            'tanggal_pengajuan' => $this->tanggal_pengajuan,
            'tanggal_diterima' => $this->tanggal_diterima,
            'is_publik' => $this->is_publik,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'nama_lembaga', $this->nama_lembaga])
            ->andFilterWhere(['like', 'nomor_sk', $this->nomor_sk])
            ->andFilterWhere(['like', 'nomor_sertifikat', $this->nomor_sertifikat])
            ->andFilterWhere(['like', 'nilai_huruf', $this->nilai_huruf])
            ->andFilterWhere(['like', 'tahun_sk', $this->tahun_sk])
            ->andFilterWhere(['like', 'dokumen_sk', $this->dokumen_sk])
            ->andFilterWhere(['like', 'sertifikat', $this->sertifikat]);

        return $dataProvider;
    }
}
