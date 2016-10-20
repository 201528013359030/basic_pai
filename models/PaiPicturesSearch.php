<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PaiPictures;

/**
 * PaiPicturesSearch represents the model behind the search form about `app\models\PaiPictures`.
 */
class PaiPicturesSearch extends PaiPictures
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fID', 'fFileName', 'fPreviewPath', 'fDownloadPath', 'fOwner', 'fUserName', 'fCreateTime', 'fDescription', 'fTaskID', 'fThumb'], 'safe'],
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
        $query = PaiPictures::find();

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
        $query->andFilterWhere(['like', 'fID', $this->fID])
            ->andFilterWhere(['like', 'fFileName', $this->fFileName])
            ->andFilterWhere(['like', 'fPreviewPath', $this->fPreviewPath])
            ->andFilterWhere(['like', 'fDownloadPath', $this->fDownloadPath])
            ->andFilterWhere(['like', 'fOwner', $this->fOwner])
            ->andFilterWhere(['like', 'fUserName', $this->fUserName])
            ->andFilterWhere(['like', 'fCreateTime', $this->fCreateTime])
            ->andFilterWhere(['like', 'fDescription', $this->fDescription])
            ->andFilterWhere(['like', 'fTaskID', $this->fTaskID])
            ->andFilterWhere(['like', 'fThumb', $this->fThumb]);

        return $dataProvider;
    }
}
