<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\User;

/**
 * UserSearch represents the model behind the search form about `common\models\User`.
 */
class UserSearch extends User
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['_id', 'username', 'auth_key', 'password_hash', 'password_reset_token', 'email', 'customer_id', 'status', 'created_at', 'updated_at', 'name', 'address', 'postcode', 'city', 'province', 'contact_no', 'company_name', 'diff_add_info', 'diff_name', 'diff_address', 'diff_postcode', 'diff_city', 'diff_province', 'diff_contact_no', 'diff_country'], 'safe'],
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
        $query = User::find();

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
        $query->andFilterWhere(['like', '_id', $this->_id])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'customer_id', $this->customer_id])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'created_at', $this->created_at])
            ->andFilterWhere(['like', 'updated_at', $this->updated_at])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'postcode', $this->postcode])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'province', $this->province])
            ->andFilterWhere(['like', 'contact_no', $this->contact_no])
            ->andFilterWhere(['like', 'company_name', $this->company_name])
            ->andFilterWhere(['like', 'diff_add_info', $this->diff_add_info])
            ->andFilterWhere(['like', 'diff_name', $this->diff_name])
            ->andFilterWhere(['like', 'diff_address', $this->diff_address])
            ->andFilterWhere(['like', 'diff_postcode', $this->diff_postcode])
            ->andFilterWhere(['like', 'diff_city', $this->diff_city])
            ->andFilterWhere(['like', 'diff_province', $this->diff_province])
            ->andFilterWhere(['like', 'diff_contact_no', $this->diff_contact_no])
            ->andFilterWhere(['like', 'diff_country', $this->diff_country]);

        return $dataProvider;
    }
}
