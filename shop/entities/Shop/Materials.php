<?php 

namespace shop\entities\shop;

use yii\db\ActiveRecord;


class Materials extends ActiveRecord
{

    const ACTIVE = 1;
    const ARCHIVE = 2;
    const DRAFT = 3;
  
    public static function create($form){
        
        $material = new static();
        $material->created_at = time();
        $material->attributes = (array)$form;
        // $material->akril_5mm = $form->akril_5mm;
        // $material->akril_3mm = $form->akril_5mm;
        // $material->akril_4mm = $form->akril_5mm;
        // $material->pvh_2mm = $form->akril_5mm;
        // $material->policarb_2mm = $form->akril_5mm;
        // $material->pet_1mm = $form->akril_5mm;
        // $material->pet_05mm = $form->akril_5mm;
        // $material->svetodiody = $form->akril_5mm;
        // $material->blok24 = $form->akril_5mm;
        // $material->blok36 = $form->akril_5mm;
        // $material->blok48 = $form->akril_5mm;
        // $material->blok60 = $form->akril_5mm;
        // $material->derj_tabl_verh = $form->akril_5mm;
        // $material->derj_dist = $form->akril_5mm;
        // $material->kronsht_cang = $form->akril_5mm;
        // $material->pechat = $form->akril_5mm;
        // $material->scoch = $form->akril_5mm;
        // $material->tross = $form->akril_5mm;
        // $material->provod = $form->akril_5mm;
        // $material->ugolok = $form->akril_5mm;
        // $material->prujina = $form->akril_5mm;
        // $material->podves_frame = $form->akril_5mm;
        // $material->profil_frame = $form->akril_5mm;
        // $material->profil_frame_2storon = $form->akril_5mm;
        // $material->profil_magnet = $form->akril_5mm;
        // $material->magnitiki = $form->akril_5mm;
        // $material->golovki = $form->akril_5mm;
        // $material->yashCost = $form->akril_5mm;
        // $material->status = Materials::DRAFT;

        return $material;
    }
    

    public function edit($form){
        $this->created_at = time();
        $this->attributes = (array)$form;
        $this->status = $form->status;
    }
    

    public static function styleLabel($status)
    {
        switch ($status) {
            case Materials::DRAFT:
                $class = 'label-danger for-status-label';
                break;
            case Materials::ACTIVE:
                $class = 'label-success for-status-label';
                break;
            case Materials::ARCHIVE:
                $class = 'label-default for-status-label';
                break;
            default:
                $class = 'label-default for-status-label';
        }
        return $class;
    }

    public static function statusLabel($status)
    {
        switch ($status) {
            case Materials::DRAFT:
                return "ЧЕРНОВИК";
                break;
            case Materials::ACTIVE:
                return "АКТИВНЫЙ";
                break;
            case Materials::ARCHIVE:
                return "АРХИВНЫЙ";
                break;
            default:
            return "НЕ ЗАДАНО";
        }
       
    }

    
    public function rules()
    {
        return [

               [[
                'akril_5mm',
                'akril_3mm',
                'akril_4mm',
                'pvh_2mm',
                'policarb_2mm',
                'pet_1mm',
                'pet_05mm',
                'svetodiody',
                'blok24',
                'blok36',
                'blok48',
                'blok60',
                'derj_tabl_verh',
                'derj_dist',
                'kronsht_cang',
                'pechat',
                'scoch',
                'tross',
                'provod',
                'ugolok',
                'prujina',
                'podves_frame',
                'profil_frame',
                'profil_frame_2storon',
                'profil_magnet',
                'magnitiki',
                'golovki',
                'yashCost'], 'number'],
            [[
                'akril_5mm',
                'akril_3mm',
                'akril_4mm',
                'pvh_2mm',
                'policarb_2mm',
                'pet_1mm',
                'pet_05mm',
                'svetodiody',
                'blok24',
                'blok36',
                'blok48',
                'blok60',
                'derj_tabl_verh',
                'derj_dist',
                'kronsht_cang',
                'pechat',
                'scoch',
                'tross',
                'provod',
                'ugolok',
                'prujina',
                'podves_frame',
                'profil_frame',
                'profil_frame_2storon',
                'profil_magnet',
                'magnitiki',
                'golovki',
                'yashCost'], 'safe'],

        ];
    }

    public static function tableName()
    {
        return '{{%materials}}';
    }

}