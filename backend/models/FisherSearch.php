<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Fisher;

/**
 * FisherSearch represents the model behind the search form about `backend\models\Fisher`.
 */
class FisherSearch extends Fisher
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['catalog_no', 'desc', 'desc_long Description', 'Std UOM', 'ProductClass', 'CATALOG NUMBER', 'CDC', 'PkgChg', 'SUPkgWgt', 'Temperature Requirements', 'StdUnitVol', 'CatlgPg', 'BOL', 'original_price
 (USD)', 'c', 'd', 'local_myr', 'e', 'asean_usd', 'f', 'asiapac_usd'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Fisher::find();

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
        ]);

        $query->andFilterWhere(['like', 'catalog_no', $this->catalog_no])
            ->andFilterWhere(['like', 'desc', $this->desc]);
            /*->andFilterWhere(['like', 'desc_long Description', $this->desc_long Description])
            ->andFilterWhere(['like', 'Std UOM', $this->Std UOM])
            ->andFilterWhere(['like', 'ProductClass', $this->ProductClass])
            ->andFilterWhere(['like', 'CATALOG NUMBER', $this->CATALOG NUMBER])
            ->andFilterWhere(['like', 'CDC', $this->CDC])
            ->andFilterWhere(['like', 'PkgChg', $this->PkgChg])
            ->andFilterWhere(['like', 'SUPkgWgt', $this->SUPkgWgt])
            ->andFilterWhere(['like', 'Temperature Requirements', $this->Temperature Requirements])
            ->andFilterWhere(['like', 'StdUnitVol', $this->StdUnitVol])
            ->andFilterWhere(['like', 'CatlgPg', $this->CatlgPg])
            ->andFilterWhere(['like', 'BOL', $this->BOL])
            ->andFilterWhere(['like', 'original_price (USD)', $this->original_price (USD)])
            ->andFilterWhere(['like', 'c', $this->c])
            ->andFilterWhere(['like', 'd', $this->d])
            ->andFilterWhere(['like', 'local_myr', $this->local_myr])
            ->andFilterWhere(['like', 'e', $this->e])
            ->andFilterWhere(['like', 'asean_usd', $this->asean_usd])
            ->andFilterWhere(['like', 'f', $this->f])
            ->andFilterWhere(['like', 'asiapac_usd', $this->asiapac_usd]);*/

        return $dataProvider;
    }
}
