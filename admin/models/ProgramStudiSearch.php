<?php

namespace admin\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ProgramStudi;

/**
 * ProgramStudiSearch represents the model behind the search form of `common\models\ProgramStudi`.
 */
class ProgramStudiSearch extends ProgramStudi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'tanggal_sk_pendirian', 'bulan_berdiri', 'tanggal_sk_operasional', 'nilai_banpt_terakhir', 'created_at', 'updated_at'], 'integer'],
            [['id_fakultas_akademi','kode', 'nama', 'jurusan_departemen', 'nomor_sk_pendirian', 'pejabat_ttd_sk_pendirian', 'tahun_berdiri', 'nomor_sk_operasional', 'peringkat_banpt_terakhir', 'nomor_sk_banpt', 'alamat', 'kodepos', 'nomor_telp', 'homepage', 'email', 'kaprodi', 'jenjang'], 'safe'],
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
        $query = ProgramStudi::find();
        $query->joinWith(['fakultasAkademi']);


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


        $dataProvider->sort->attributes['id_fakultas_akademi']=[
            'asc'=>['fakultas_akademi.nama'=>SORT_ASC],
            'desc'=>['fakultas_akademi.nama'=>SORT_DESC]
        ];
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'tanggal_sk_pendirian' => $this->tanggal_sk_pendirian,
            'bulan_berdiri' => $this->bulan_berdiri,
            'tanggal_sk_operasional' => $this->tanggal_sk_operasional,
            'nilai_banpt_terakhir' => $this->nilai_banpt_terakhir,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'kode', $this->kode])
            ->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'fakultas_akademi.nama', $this->id_fakultas_akademi])
            ->andFilterWhere(['like', 'jurusan_departemen', $this->jurusan_departemen])
            ->andFilterWhere(['like', 'nomor_sk_pendirian', $this->nomor_sk_pendirian])
            ->andFilterWhere(['like', 'pejabat_ttd_sk_pendirian', $this->pejabat_ttd_sk_pendirian])
            ->andFilterWhere(['like', 'tahun_berdiri', $this->tahun_berdiri])
            ->andFilterWhere(['like', 'nomor_sk_operasional', $this->nomor_sk_operasional])
            ->andFilterWhere(['like', 'peringkat_banpt_terakhir', $this->peringkat_banpt_terakhir])
            ->andFilterWhere(['like', 'nomor_sk_banpt', $this->nomor_sk_banpt])
            ->andFilterWhere(['like', 'alamat', $this->alamat])
            ->andFilterWhere(['like', 'kodepos', $this->kodepos])
            ->andFilterWhere(['like', 'nomor_telp', $this->nomor_telp])
            ->andFilterWhere(['like', 'homepage', $this->homepage])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'kaprodi', $this->kaprodi])
            ->andFilterWhere(['like', 'jenjang', $this->jenjang]);

        return $dataProvider;
    }
}
