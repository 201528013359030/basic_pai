<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SysSeqnos;

/**
 * SysSeqnosSearch represents the model behind the search form about `app\models\SysSeqnos`.
 */
class SysSeqnosSearch extends SysSeqnos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['DM', 'TABLENAME', 'FIELDNAME', 'BZ', 'QLB', 'HLB', 'DQDM', 'SFSJBS', 'SX', 'WS'], 'safe'],
            [['MAXSEQNO'], 'integer'],
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
        $query = SysSeqnos::find();

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
            'MAXSEQNO' => $this->MAXSEQNO,
        ]);

        $query->andFilterWhere(['like', 'DM', $this->DM])
            ->andFilterWhere(['like', 'TABLENAME', $this->TABLENAME])
            ->andFilterWhere(['like', 'FIELDNAME', $this->FIELDNAME])
            ->andFilterWhere(['like', 'BZ', $this->BZ])
            ->andFilterWhere(['like', 'QLB', $this->QLB])
            ->andFilterWhere(['like', 'HLB', $this->HLB])
            ->andFilterWhere(['like', 'DQDM', $this->DQDM])
            ->andFilterWhere(['like', 'SFSJBS', $this->SFSJBS])
            ->andFilterWhere(['like', 'SX', $this->SX])
            ->andFilterWhere(['like', 'WS', $this->WS]);

        return $dataProvider;
    }
}
