<?php
namespace frontend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\BugReportModel;


class BugReportSearch extends Model
{
    public $q;
    public $status;
    public $severity;


    public function rules()
    {
        return [
            [['q', 'status', 'severity'], 'safe'],
        ];
    }


    public function search($params)
    {
        $query = BugReportModel::find();


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
            'defaultOrder' => ['created_at' => SORT_DESC],
            'attributes' => [
                'created_at', 'updated_at', 'severity', 'status', 'title'
                ],
            ],
            'pagination' => [
            'pageSize' => 20,
            ],
        ]);


        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }


        if ($this->q) {
            $query->andFilterWhere(['or',
                ['like', 'title', $this->q],
                ['like', 'reporter_name', $this->q],
            ]);
        }
        if ($this->status) {
            $query->andWhere(['status' => $this->status]);
        }
        if ($this->severity) {
            $query->andWhere(['severity' => $this->severity]);
        }


        return $dataProvider;
    }
}