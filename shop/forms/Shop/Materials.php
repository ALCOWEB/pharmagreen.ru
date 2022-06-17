<?php
/**
 * Created by PhpStorm.
 * User: СамецМужчина
 * Date: 30.01.2020
 * Time: 19:12
 */
namespace shop\forms\Shop;

use yii\base\Model;

class Materials extends Model
{

    public $akril_5mm;
    public $akril_3mm;
    public $akril_4mm;
    public $pvh_2mm;
    public $policarb_2mm;
    public $pet_1mm;
    public $pet_05mm;
    public $svetodiody;
    public $blok24;
    public $blok36;
    public $blok48;
    public $blok60;
    public $derj_tabl_verh;
    public $kronsht_cang;
    public $derj_dist;
    public $pechat;
    public $scoch;
    public $tross;
    public $provod;
    public $ugolok;
    public $prujina;
    public $podves_frame;
    public $profil_frame;
    public $profil_frame_2storon;
    public $profil_magnet;
    public $magnitiki;
    public $golovki;
    public $yashCost;
    public $status;


    public function __construct(array $config = [])
    { $this->akril_5mm = 2350;
        $this->akril_3mm= 1600;
        $this->akril_4mm= 2100;
        $this->pvh_2mm= 335;
        $this->policarb_2mm= 1000;
        $this->pet_1mm= 371;
        $this->pet_05mm= 304;
        $this->svetodiody= 210;
        $this->blok24= 312;
        $this->blok36= 370;
        $this->blok48= 470;
        $this->blok60= 550;
        $this->derj_tabl_verh= 140;
        $this->kronsht_cang= 80;
        $this->derj_dist= 50;
        $this->pechat= 1000;
        $this->scoch= 4;
        $this->tross= 10;
        $this->provod= 15;
        $this->ugolok= 18;
        $this->prujina= 7;
        $this->podves_frame= 20;
        $this->profil_frame= round(1100/3, 0);
        $this->profil_frame_2storon= round(1600/3, 0);
        $this->profil_magnet= round(630/3, 0);
        $this->magnitiki= 11;
        $this->golovki = 40;
        $this->yashCost = 0;
        $this->status = 0;
        parent::__construct($config);
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
                'yashCost',
                'status',], 'number'],
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
                'yashCost'], 'required'],

        ];
    }

}