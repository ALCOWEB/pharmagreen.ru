<?php


namespace backend\forms\Shop;


use shop\entities\shop\Materials;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class MaterialSearch extends Materials
{


  

  
    // public function rules()
    // {
    //     return [

    //         [[
    //          'akril_5mm',
    //          'akril_3mm',
    //          'akril_4mm',
    //          'pvh_2mm',
    //          'policarb_2mm',
    //          'pet_1mm',
    //          'pet_05mm',
    //          'svetodiody',
    //          'blok24',
    //          'blok36',
    //          'blok48',
    //          'blok60',
    //          'derj_tabl_verh',
    //          'derj_dist',
    //          'kronsht_cang',
    //          'pechat',
    //          'scoch',
    //          'tross',
    //          'provod',
    //          'ugolok',
    //          'prujina',
    //          'podves_frame',
    //          'profil_frame',
    //          'profil_frame_2storon',
    //          'profil_magnet',
    //          'magnitiki',
    //          'golovki',
    //          'yashCost'], 'number'],
    //      [[
    //          'akril_5mm',
    //          'akril_3mm',
    //          'akril_4mm',
    //          'pvh_2mm',
    //          'policarb_2mm',
    //          'pet_1mm',
    //          'pet_05mm',
    //          'svetodiody',
    //          'blok24',
    //          'blok36',
    //          'blok48',
    //          'blok60',
    //          'derj_tabl_verh',
    //          'derj_dist',
    //          'kronsht_cang',
    //          'pechat',
    //          'scoch',
    //          'tross',
    //          'provod',
    //          'ugolok',
    //          'prujina',
    //          'podves_frame',
    //          'profil_frame',
    //          'profil_frame_2storon',
    //          'profil_magnet',
    //          'magnitiki',
    //          'golovki',
    //          'yashCost'], 'required'],

    //  ];
    // }



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
        $query = Materials::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC
                ]
            ]
        ]);


        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

     

        return $dataProvider;
    }


}