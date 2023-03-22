<?php
/**
 * Created by PhpStorm.
 * User: СамецМужчина
 * Date: 19.09.2020
 * Time: 15:42
 */

namespace backend\forms\shop;
use shop\entities\Shop\PaymentMethod;
use yii\base\Model;
use yii\data\ActiveDataProvider;



class PaymentMethodSearch extends Model
{
    public $id;
    public $name;

    public function rules(): array
    {
        return [
            [['id'], 'integer'],
            [['name'], 'safe'],
        ];
    }

    public function search(array $params): ActiveDataProvider
    {
        $query = PaymentMethod::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id' => SORT_ASC]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query
            ->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }

}