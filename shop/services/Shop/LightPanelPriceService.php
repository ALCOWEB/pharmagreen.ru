<?php
namespace shop\services\Shop;
use shop\entities\Shop\Product\Product;
use shop\repositories\Shop\ProductRepository;
use shop\repositories\Shop\CharacteristicRepository;
use shop\repositories\Shop\MaterialsRepository;
use shop\entities\shop\Materials;
use shop\helpers\ProductHelper;
use shop\entities\Shop\Product\Value;


class LightPanelPriceService{

    public $products;
    public $materials;
    public $characteristics;



    public function __construct(ProductRepository $products, MaterialsRepository $materials,CharacteristicRepository $characteristics )
    {
       $this->products = $products;
       $this->materials = $materials->getActive();
       $this->characteristics = $characteristics;
      

    }
    
    public function calcPrice(Product $product){
        $characteristics_id = $this->characteristics->getIds();
        $characteristics = array_map(function(Value $value){
            return [$value->characteristic->name => $value->value];
        },$product->values);
        $characteristicHash = [];
        foreach($characteristics as $val){
            $characteristicHash[key($val)] = $val[key($val)];
        }
     //   return  $characteristicHash;
        $sizes = $this->getRealSize($product, $characteristicHash);

   
        if ($product->category->name == 'Кристалайт' && $characteristicHash['Ценовой сегмент'] == "Стандарт" && $characteristicHash['Вариант крепления'] == 'Настенная' && $characteristicHash['Количество сторон'] == 'Односторонняя')
        { 
            
           
            $materials = [
                'Акрил' =>[$sizes['ploshad_vnesh'],$this->materials->akril_5mm],
                'Печать' =>[$sizes['ploshad_vnut'],$this->materials->pechat],
                'ПВХ' =>[$sizes['ploshad_vnut'],$this->materials->pvh_2mm],
                'Защитка' =>[$sizes['ploshad_vnesh'],$this->materials->policarb_2mm],
                //'Проставка' =>[$real_sizez['ploshad_vnesh'],$materials->policarb_2mm],
                'Светодиоды' =>[$sizes['dlina_diod'],$this->materials->svetodiody],
                //'Кронштейны цанг' =>[2,$materials->kronsht_cang],
                //'Держатели верхние' =>[2,$materials->derj_tabl_verh],
                'Дисты' =>[4,$this->materials->derj_dist],
                'Скотч' =>[$sizes['perimetr_vnut']*2,$this->materials->scoch],
               // 'Головки' =>[$sizes['perimetr_vnesh']/0.375-4,$this->materials->golovki],
                'Блок' =>[1,$this->blockPower($sizes['dlina_diod'], $this->materials)],
                'Тросс' =>[4,$this->materials->tross],
                'Фрезеровка' =>[$sizes['perimetr_vnesh']*3,40],
                'Ящики' =>[1, $this->materials->yashCost],
            ];
            $prices = $this->price_real($materials, $sizes['ploshad_vnesh'], $product);
            $product->setPrice($prices[0], $prices[1]);
            $product->setValue($characteristics_id['Толщина'], (5+2+2));
            $product->setValue($characteristics_id['Напряжение питания'], 12);
            $product->setValue($characteristics_id['Потребляемая мощность'], round($sizes['dlina_diod']*11));
            $product->weight = $sizes['ploshad_vnesh']*0.005*1.19*1000 + $sizes['ploshad_vnesh']*0.002*1.2*1000 + $sizes['ploshad_vnesh']*0.002*0.55*1000 + 0.2;

        } 
        if ($product->category->name == 'Кристалайт' && $characteristicHash['Ценовой сегмент'] == "Стандарт" && $characteristicHash['Вариант крепления'] == 'Подвесная'  &&    $characteristicHash['Количество сторон'] == 'Односторонняя') 
        {
           
            $materials = [
                'Акрил' =>[$sizes['ploshad_vnesh'],$this->materials->akril_5mm],
                'Печать' =>[$sizes['ploshad_vnut'],$this->materials->pechat],
                'ПВХ' =>[$sizes['ploshad_vnut'],$this->materials->pvh_2mm],
                'Защитка' =>[$sizes['ploshad_vnesh'],$this->materials->policarb_2mm],
                //'Проставка' =>[$real_sizez['ploshad_vnesh'],$materials->policarb_2mm],
                'Светодиоды' =>[$sizes['dlina_diod'],$this->materials->svetodiody],
                'Кронштейны цанг' =>[2,$this->materials->kronsht_cang],
                'Держатели верхние' =>[2,$this->materials->derj_tabl_verh],
                //'Дисты' =>[4,$this->materials->derj_dist],
                'Скотч' =>[$sizes['perimetr_vnut']*2,$this->materials->scoch],
                'Головки' =>[$sizes['perimetr_vnesh']/0.375-4,$this->materials->golovki],
                'Блок' =>[1,$this->blockPower($sizes['dlina_diod'], $this->materials)],
                'Тросс' =>[4,$this->materials->tross],
                'Фрезеровка' =>[$sizes['perimetr_vnesh']*3,40],
            ];
            $prices = $this->price_real($materials, $sizes['ploshad_vnesh'], $product);
            $product->setPrice($prices[0], $prices[1]);
            $product->setValue($characteristics_id['Толщина'], (5+2+2));
            $product->setValue($characteristics_id['Напряжение питания'], 12);
            $product->setValue($characteristics_id['Потребляемая мощность'], round($sizes['dlina_diod']*11));
            $product->weight = $sizes['ploshad_vnesh']*0.005*1.19*1000 + $sizes['ploshad_vnesh']*0.002*1.2*1000 + $sizes['ploshad_vnesh']*0.002*0.55*1000 + 0.2;

        }
     
        if ($product->category->name == 'Кристалайт' && $characteristicHash['Ценовой сегмент'] == "Стандарт" && $characteristicHash['Вариант крепления'] == 'Подвесная'  &&    $characteristicHash['Количество сторон'] == 'Двухсторонняя') 
        {
           
            $materials = [
                'Акрил' =>[$sizes['ploshad_vnesh'],$this->materials->akril_5mm],
                'Печать' =>[$sizes['ploshad_vnut'],$this->materials->pechat],
                //'ПВХ' =>[$sizes['ploshad_vnut'],$this->materials->pvh_2mm/2],
                'Защитка' =>[$sizes['ploshad_vnesh']*2,$this->materials->policarb_2mm],
                'Проставка' =>[$sizes['ploshad_vnesh'],$this->materials->policarb_2mm],
                'Светодиоды' =>[$sizes['dlina_diod'],$this->materials->svetodiody],
                'Кронштейны цанг' =>[2,$this->materials->kronsht_cang],
                'Держатели верхние' =>[2,$this->materials->derj_tabl_verh],
                //'Дисты' =>[4,$this->materials->derj_dist],
                'Скотч' =>[$sizes['perimetr_vnut'],$this->materials->scoch],
                'Головки' =>[$sizes['perimetr_vnesh']/0.375*2-4,$this->materials->golovki],
                'Блок' =>[1,$this->blockPower($sizes['dlina_diod'], $this->materials)],
                'Тросс' =>[4,$this->materials->tross],
                'Фрезеровка' =>[$sizes['perimetr_vnesh']*4,40],
            ];
            $prices = $this->price_real($materials, $sizes['ploshad_vnesh'], $product);
            $product->setPrice($prices[0], $prices[1]);
            $product->setValue($characteristics_id['Толщина'], (5+2+2+2));
            $product->setValue($characteristics_id['Напряжение питания'], 12);
            $product->setValue($characteristics_id['Потребляемая мощность'], round($sizes['dlina_diod']*11));
            $product->weight = $sizes['ploshad_vnesh']*0.005*1.19*1000 + $sizes['ploshad_vnesh']*0.002*1.2*1000*3 + 0.2;
          

        }

        
        // if ($product->category->name == 'Кристалайт' && $characteristicHash['Ценовой сегмент'] == "Стандарт" && $characteristicHash['Вариант крепления'] == 'Подвесная'  &&    $characteristicHash['Количество сторон'] == 'Двухсторонняя' && $characteristicHash['Количество матриц'] == 2) 
        // {
           
        //     $materials = [
        //         'Акрил' =>[$sizes['ploshad_vnesh']*2,$this->materials->akril_5mm],
        //         'Печать' =>[$sizes['ploshad_vnut']*2,$this->materials->pechat],
        //         'ПВХ' =>[$sizes['ploshad_vnut'],$this->materials->pvh_2mm/2],
        //         'Защитка' =>[$sizes['ploshad_vnesh']*2,$this->materials->policarb_2mm],
        //         //'Проставка' =>[$sizes['ploshad_vnesh'],$materials->policarb_2mm],
        //         'Светодиоды' =>[$sizes['dlina_diod']*2,$this->materials->svetodiody],
        //         'Кронштейны цанг' =>[2,$this->materials->kronsht_cang],
        //         'Держатели верхние' =>[2,$this->materials->derj_tabl_verh],
        //         //'Дисты' =>[4,$this->materials->derj_dist],
        //         'Скотч' =>[$sizes['perimetr_vnut']*2,$this->materials->scoch],
        //         'Головки' =>[$sizes['perimetr_vnesh']/0.375*2-4,$this->materials->golovki],
        //         'Блок' =>[1,$this->blockPower($sizes['dlina_diod']*2, $this->materials)],
        //         'Тросс' =>[4,$this->materials->tross],
        //         'Фрезеровка' =>[$sizes['perimetr_vnesh']*4,40],
        //     ];
        //     $prices = $this->price_real($materials, $sizes['ploshad_vnesh'], $product);
        //     $product->setPrice($prices[0], $prices[1]);
        //     $product->setValue($characteristics_id['Толщина'], (5+5+2+2));
        //     $product->setValue($characteristics_id['Напряжение питания'], 12);
        //     $product->setValue($characteristics_id['Потребляемая мощность'], round($sizes['dlina_diod']*11*2));
        //     $product->weight = $sizes['ploshad_vnesh']*0.005*1.19*1000*2 + $sizes['ploshad_vnesh']*0.002*1.2*1000*2 + 0.2;
            
        // }


        

        if ($product->category->name == 'Фреймлайт' && $characteristicHash['Ценовой сегмент'] == "Стандарт" && $characteristicHash['Вариант крепления'] == 'Настенная' && $characteristicHash['Количество сторон'] == 'Односторонняя')
        {
           
            $materials = [
                'Акрил' =>[$sizes['ploshad_vnut'],$this->materials->akril_5mm],
                'Печать' =>[$sizes['ploshad_vnut'],$this->materials->pechat],
                'ПВХ' =>[$sizes['ploshad_vnut'],$this->materials->pvh_2mm],
                'Защитка' =>[$sizes['ploshad_vnut'],$this->materials->pet_1mm],
                'Светодиоды' =>[$sizes['dlina_diod'],$this->materials->svetodiody],
                'Профиль фрейм' =>[$sizes['perimetr_vnesh'],$this->materials->profil_frame],
                'Пружинки' =>[$sizes['perimetr_vnesh']/0.15,$this->materials->prujina],
                'Скотч' =>[$sizes['perimetr_vnut']*2,$this->materials->scoch],
                'Блок' =>[1,$this->blockPower($sizes['dlina_diod'], $this->materials)],
                'Провод' =>[2,$this->materials->provod],
            ];
            $prices = $this->price_real($materials, $sizes['ploshad_vnesh'], $product);
            $product->setPrice($prices[0], $prices[1]);
            $product->setValue($characteristics_id['Толщина'], (23));
            $product->setValue($characteristics_id['Напряжение питания'], 12);
            $product->setValue($characteristics_id['Потребляемая мощность'], round($sizes['dlina_diod']*11));
            $product->weight = $sizes['ploshad_vnesh']*0.005*1.19*1000 + $sizes['ploshad_vnesh']*0.002*0.55*1000 + $sizes['ploshad_vnesh']*0.001*1.2*1000*1 + $sizes['perimetr_vnesh']*0.490 + 0.2;

        } 
        if ($product->category->name == 'Фреймлайт' && $characteristicHash['Ценовой сегмент'] == "Стандарт" && $characteristicHash['Вариант крепления'] == 'Подвесная'  &&    $characteristicHash['Количество сторон'] == 'Односторонняя') 
        {
           
            $materials = [
                'Акрил' =>[$sizes['ploshad_vnut'],$this->materials->akril_5mm],
                'Печать' =>[$sizes['ploshad_vnut'],$this->materials->pechat],
                'ПВХ' =>[$sizes['ploshad_vnut'],$this->materials->pvh_2mm],
                'Защитка' =>[$sizes['ploshad_vnut'],$this->materials->pet_1mm],
                'Светодиоды' =>[$sizes['dlina_diod'],$this->materials->svetodiody],
                'Профиль фрейм' =>[$sizes['perimetr_vnesh'],$this->materials->profil_frame],
                'Пружинки' =>[$sizes['perimetr_vnesh']/0.15,$this->materials->prujina],
                'Кронштейны цанг' =>[2,$this->materials->kronsht_cang],
                'Скотч' =>[$sizes['perimetr_vnut']*2,$this->materials->scoch],
                'Блок' =>[1,$this->blockPower($sizes['dlina_diod'], $this->materials)],
                'Провод' =>[2,$this->materials->provod],
            ];
            $prices = $this->price_real($materials, $sizes['ploshad_vnesh'], $product);
            $product->setPrice($prices[0], $prices[1]);
            $product->setValue($characteristics_id['Толщина'], (23));
            $product->setValue($characteristics_id['Напряжение питания'], 12);
            $product->setValue($characteristics_id['Потребляемая мощность'], round($sizes['dlina_diod']*11));
            $product->weight = $sizes['ploshad_vnesh']*0.005*1.19*1000 + $sizes['ploshad_vnesh']*0.002*0.55*1000 + $sizes['ploshad_vnesh']*0.001*1.2*1000*1 + $sizes['perimetr_vnesh']*0.490 + 0.2;

        }

        if ($product->category->name == 'Фреймлайт' && $characteristicHash['Ценовой сегмент'] == "Стандарт" && $characteristicHash['Вариант крепления'] == 'Подвесная'  &&    $characteristicHash['Количество сторон'] == 'Двухсторонняя') 
        {
           
            $materials = [
                'Акрил' =>[$sizes['ploshad_vnut'],$this->materials->akril_5mm],
                'Печать' =>[$sizes['ploshad_vnut'],$this->materials->pechat],
                'Проставка' =>[$sizes['ploshad_vnesh'],$this->materials->policarb_2mm],
                'Защитка' =>[$sizes['ploshad_vnut']*2,$this->materials->pet_1mm],
                'Светодиоды' =>[$sizes['dlina_diod'],$this->materials->svetodiody],
                'Профиль фрейм' =>[$sizes['perimetr_vnesh'],$this->materials->profil_frame_2storon],
                'Пружинки' =>[$sizes['perimetr_vnesh']/0.15*2,$this->materials->prujina],
                'Кронштейны цанг' =>[2,$this->materials->kronsht_cang],
                'Скотч' =>[$sizes['perimetr_vnut']*2,$this->materials->scoch],
                'Блок' =>[1,$this->blockPower($sizes['dlina_diod'], $this->materials)],
                'Тросс' =>[4,$this->materials->tross],
                'Провод' =>[2,$this->materials->provod],
            ];
            $prices = $this->price_real($materials, $sizes['ploshad_vnesh'], $product);
            $product->setPrice($prices[0], $prices[1]);
            $product->setValue($characteristics_id['Толщина'], (32));
            $product->setValue($characteristics_id['Напряжение питания'], 12);
            $product->setValue($characteristics_id['Потребляемая мощность'], round($sizes['dlina_diod']*11*2));
            $product->weight =  $sizes['ploshad_vnesh']*0.005*1.19*1000 + $sizes['ploshad_vnesh']*0.002*1.2*1000 + $sizes['ploshad_vnesh']*0.001*1.2*1000*2 + $sizes['perimetr_vnesh']*0.590 + 0.2;
            foreach($product->modifications as $modification){
                //var_dump($modification);
                $materials = [
                    'Акрил' =>[$sizes['ploshad_vnut']*2,$this->materials->akril_4mm],
                    'Печать' =>[$sizes['ploshad_vnut']*2,$this->materials->pechat],
                    'ПВХ' =>[$sizes['ploshad_vnut'],$this->materials->pvh_2mm/2],
                    'Защитка' =>[$sizes['ploshad_vnut']*2,$this->materials->pet_1mm],
                    'Светодиоды' =>[$sizes['dlina_diod']*2,$this->materials->svetodiody],
                    'Профиль фрейм' =>[$sizes['perimetr_vnesh'],$this->materials->profil_frame_2storon],
                    'Пружинки' =>[$sizes['perimetr_vnesh']/0.15*2,$this->materials->prujina],
                    'Кронштейны цанг' =>[2,$this->materials->kronsht_cang],
                    'Скотч' =>[$sizes['perimetr_vnut']*4,$this->materials->scoch],
                    'Блок' =>[1,$this->blockPower($sizes['dlina_diod']*2, $this->materials)],
                    'Тросс' =>[4,$this->materials->tross],
                    'Провод' =>[2,$this->materials->provod],
                ];
                $prices = $this->price_real($materials, $sizes['ploshad_vnesh'], $product);
                $product->editModification($modification->id, $modification->code, $modification->name, $prices[0], 1000);
               // var_dump($modification);
            }
        }


        
        // if ($product->category->name == 'Фреймлайт' && $characteristicHash['Ценовой сегмент'] == "Стандарт" && $characteristicHash['Вариант крепления'] == 'Подвесная'  &&    $characteristicHash['Количество сторон'] == 'Двухсторонняя'  && $characteristicHash['Количество матриц'] == 2) 
        // {
           
        //     $materials = [
        //         'Акрил' =>[$sizes['ploshad_vnut']*2,$this->materials->akril_4mm],
        //         'Печать' =>[$sizes['ploshad_vnut']*2,$this->materials->pechat],
        //         'ПВХ' =>[$sizes['ploshad_vnut'],$this->materials->pvh_2mm/2],
        //         'Защитка' =>[$sizes['ploshad_vnut']*2,$this->materials->pet_1mm],
        //         'Светодиоды' =>[$sizes['dlina_diod']*2,$this->materials->svetodiody],
        //         'Профиль фрейм' =>[$sizes['perimetr_vnesh'],$this->materials->profil_frame_2storon],
        //         'Пружинки' =>[$sizes['perimetr_vnesh']/0.15*2,$this->materials->prujina],
        //         'Кронштейны цанг' =>[2,$this->materials->kronsht_cang],
        //         'Скотч' =>[$sizes['perimetr_vnut']*4,$this->materials->scoch],
        //         'Блок' =>[1,$this->blockPower($sizes['dlina_diod']*2, $this->materials)],
        //         'Тросс' =>[4,$this->materials->tross],
        //         'Провод' =>[2,$this->materials->provod],
        //     ];
        //     $prices = $this->price_real($materials, $sizes['ploshad_vnesh'], $product);
        //     $product->setPrice($prices[0], $prices[1]);
        //     $product->setValue($characteristics_id['Толщина'], (32));
        //     $product->setValue($characteristics_id['Напряжение питания'], 12);
        //     $product->setValue($characteristics_id['Потребляемая мощность'], round($sizes['dlina_diod']*11*2));
        //     $product->weight =  $sizes['ploshad_vnesh']*0.004*1.19*1000*2 + $sizes['ploshad_vnesh']*0.001*1.2*1000*2 + $sizes['perimetr_vnesh']*0.590 + 0.2;
        // }
        
        if ($product->category->name == 'Магнетик' && $characteristicHash['Ценовой сегмент'] == "Стандарт" && $characteristicHash['Вариант крепления'] == 'Настенная' && $characteristicHash['Количество сторон'] == 'Односторонняя')
        {
           
            $materials = [
                'Акрил' =>[$sizes['ploshad_vnut'],$this->materials->akril_5mm],
                'Печать' =>[$sizes['ploshad_vnut'],$this->materials->pechat],
                'ПВХ' =>[$sizes['ploshad_vnut'],$this->materials->pvh_2mm],
                'Защитка полик' =>[$sizes['ploshad_vnut'],$this->materials->policarb_2mm],
                'Светодиоды' =>[$sizes['dlina_diod'],$this->materials->svetodiody],
                'Профиль магнетик' =>[$sizes['perimetr_vnesh'],$this->materials->profil_magnet],
               // 'Пружинки' =>[$sizes['perimetr_vnesh']/0.15,$materials->prujina],
                'Магнитики' =>[$sizes['perimetr_vnesh']/0.15,$this->materials->magnitiki],
                'Скотч' =>[$sizes['perimetr_vnut']*3,$this->materials->scoch],
                'Блок' =>[1,$this->blockPower($sizes['dlina_diod'], $this->materials)],
                'Провод' =>[2,$this->materials->provod],
            ];
            $prices = $this->price_real($materials, $sizes['ploshad_vnesh'], $product);
            $product->setPrice($prices[0], $prices[1]);
            $product->setValue($characteristics_id['Толщина'], (16));
            $product->setValue($characteristics_id['Напряжение питания'], 12);
            $product->setValue($characteristics_id['Потребляемая мощность'], round($sizes['dlina_diod']*11));
            $product->weight = $sizes['ploshad_vnesh']*0.005*1.19*1000 + $sizes['ploshad_vnesh']*0.002*0.55*1000 + $sizes['ploshad_vnesh']*0.002*1.2*1000*1 + $sizes['perimetr_vnesh']*0.290 + 0.2;

        } 
        if ($product->category->name == 'Магнетик' && $characteristicHash['Ценовой сегмент'] == "Стандарт" && $characteristicHash['Вариант крепления'] == 'Подвесная'  &&    $characteristicHash['Количество сторон'] == 'Односторонняя') 
        {
           
            $materials = [
                'Акрил' =>[$sizes['ploshad_vnut'],$this->materials->akril_5mm],
                'Печать' =>[$sizes['ploshad_vnut'],$this->materials->pechat],
                'ПВХ' =>[$sizes['ploshad_vnut'],$this->materials->pvh_2mm],
                'Защитка полик' =>[$sizes['ploshad_vnut'],$this->materials->policarb_2mm],
                'Светодиоды' =>[$sizes['dlina_diod'],$this->materials->svetodiody],
                'Профиль магнетик' =>[$sizes['perimetr_vnesh'],$this->materials->profil_frame],
                'Кронштейны цанг' =>[2,$this->materials->kronsht_cang],
                'Магнитики' =>[$sizes['perimetr_vnesh']/0.15,$this->materials->magnitiki],
                'Скотч' =>[$sizes['perimetr_vnut']*3,$this->materials->scoch],
                'Блок' =>[1,$this->blockPower($sizes['dlina_diod'], $this->materials)],
                'Тросс' =>[4,$this->materials->tross],
                'Провод' =>[2,$this->materials->provod],
            ];
            $prices = $this->price_real($materials, $sizes['ploshad_vnesh'], $product);
            $product->setPrice($prices[0], $prices[1]);
            $product->setValue($characteristics_id['Толщина'], (16));
            $product->setValue($characteristics_id['Напряжение питания'], 12);
            $product->setValue($characteristics_id['Потребляемая мощность'], round($sizes['dlina_diod']*11));
            $product->weight = $sizes['ploshad_vnesh']*0.005*1.19*1000 + $sizes['ploshad_vnesh']*0.002*0.55*1000 + $sizes['ploshad_vnesh']*0.002*1.2*1000*1 + $sizes['perimetr_vnesh']*0.290 + 0.2;

        }

        // if ($product->category->name == 'Магнетик' && $characteristicHash['Ценовой сегмент'] == "Стандарт" && $characteristicHash['Вариант крепления'] == 'Подвесная'  &&    $characteristicHash['Количество сторон'] == 'Двухсторонняя'  &&  $characteristicHash['Количество матриц'] == 2) 
        // {
           
        //     $materials = [
        //         'Акрил' =>[$sizes['ploshad_vnut']*2,$this->materials->akril_4mm],
        //         'Печать' =>[$sizes['ploshad_vnut']*2,$this->materials->pechat],
        //         'Защитка полик' =>[$sizes['ploshad_vnut']*2,$this->materials->policarb_2mm],
        //         'Проставка' =>[$sizes['ploshad_vnut'],$this->materials->pvh_2mm/2],
        //         'Светодиоды' =>[$sizes['dlina_diod']*2,$this->materials->svetodiody],
        //         'Профиль магнетик' =>[$sizes['perimetr_vnesh']*2,$this->materials->profil_magnet],    
        //         'Кронштейны цанг' =>[2,$this->materials->kronsht_cang],
        //         'Скотч' =>[$sizes['perimetr_vnut']*6,$this->materials->scoch],
        //         'Магнитики' =>[$sizes['perimetr_vnesh']/0.15*2,$this->materials->magnitiki],
        //         'Блок' =>[1,$this->blockPower($sizes['dlina_diod']*2, $this->materials)],
        //         'Тросс' =>[4,$this->materials->tross],
        //         'Провод' =>[2,$this->materials->provod],
        //     ];
        //     $prices = $this->price_real($materials, $sizes['ploshad_vnesh'], $product);
        //     $product->setPrice($prices[0], $prices[1]);
        //     $product->setValue($characteristics_id['Толщина'], (32));
        //     $product->setValue($characteristics_id['Напряжение питания'], 12);
        //     $product->setValue($characteristics_id['Потребляемая мощность'], round($sizes['dlina_diod']*11*2));
        //     $product->weight =  $sizes['ploshad_vnesh']*0.004*1.19*1000*2 + $sizes['ploshad_vnesh']*0.002*1.2*1000*2 + $sizes['perimetr_vnesh']*0.590 + 0.2;
        // }
        
        if ($product->category->name == 'Магнетик' && $characteristicHash['Ценовой сегмент'] == "Стандарт" && $characteristicHash['Вариант крепления'] == 'Подвесная'  &&    $characteristicHash['Количество сторон'] == 'Двухсторонняя') 
        {
           
            $materials = [
                'Акрил' =>[$sizes['ploshad_vnut'],$this->materials->akril_5mm],
                'Печать' =>[$sizes['ploshad_vnut'],$this->materials->pechat],
                'Защитка полик' =>[$sizes['ploshad_vnut']*2,$this->materials->policarb_2mm],
                'Проставка' =>[$sizes['ploshad_vnut'],$this->materials->policarb_2mm],
                'Светодиоды' =>[$sizes['dlina_diod'],$this->materials->svetodiody],
                'Профиль магнетик' =>[$sizes['perimetr_vnesh']*2,$this->materials->profil_magnet],    
                'Кронштейны цанг' =>[2,$this->materials->kronsht_cang],
                'Скотч' =>[$sizes['perimetr_vnut']*6,$this->materials->scoch],
                'Магнитики' =>[$sizes['perimetr_vnesh']/0.15*2,$this->materials->magnitiki],
                'Блок' =>[1,$this->blockPower($sizes['dlina_diod'], $this->materials)],
                'Тросс' =>[4,$this->materials->tross],
                'Провод' =>[2,$this->materials->provod],
            ];
            $prices = $this->price_real($materials, $sizes['ploshad_vnesh'], $product);
            $product->setPrice($prices[0], $prices[1]);
            $product->setValue($characteristics_id['Толщина'], (32));
            $product->setValue($characteristics_id['Напряжение питания'], 12);
            $product->setValue($characteristics_id['Потребляемая мощность'], round($sizes['dlina_diod']*11*2));
            $product->weight =  $sizes['ploshad_vnesh']*0.005*1.19*1000 + $sizes['ploshad_vnesh']*0.002*1.2*1000*3 + $sizes['perimetr_vnesh']*0.590 + 0.2;
        }

                
    
    
    
  
       
    }

    
    public function getRealSize(Product $product, $characteristics){
                $width = $characteristics['Ширина'];
                $height =  $characteristics['Высота'];
                if($product->category->name == 'Кристалайт'){
                   
                    $ploshad_vnesh = ($width)*($height)/1000/1000;
                    $ploshad_vnut = ($width-100)*($height-100)/1000/1000;
                    $perimetr_vnesh = ($width+$height)/1000*2;
                    $perimetr_vnut = ($width-100+$height-100)/1000*2;
                    $dlina_diod = (($height >= $width) ? ($height -100) : ($width - 100))*2/1000;
                    return ['ploshad_vnesh' => $ploshad_vnesh,
                            'ploshad_vnut' => $ploshad_vnut,
                            'perimetr_vnesh' => $perimetr_vnesh,
                            'perimetr_vnut' => $perimetr_vnut,
                            'dlina_diod' => $dlina_diod,];
                    
                }

                if($product->category->name == 'Фреймлайт'){
                   
                    $ploshad_vnesh = ($width)*($height)/1000/1000;
                    $ploshad_vnut = ($width-30)*($height-30)/1000/1000;
                    $perimetr_vnesh = ($width+$height)/1000*2;
                    $perimetr_vnut = ($width-30+$height-30)/1000*2;
                    $dlina_diod = (($height >= $width) ? ($height -30) : ($width - 30))*2/1000;
                    return ['ploshad_vnesh' => $ploshad_vnesh,
                            'ploshad_vnut' => $ploshad_vnut,
                            'perimetr_vnesh' => $perimetr_vnesh,
                            'perimetr_vnut' => $perimetr_vnut,
                            'dlina_diod' => $dlina_diod,];
                    
                }

                if($product->category->name == 'Магнетик'){
                   
                    $ploshad_vnesh = ($width)*($height)/1000/1000;
                    $ploshad_vnut = ($width-30)*($height-30)/1000/1000;
                    $perimetr_vnesh = ($width+$height)/1000*2;
                    $perimetr_vnut = ($width-30+$height-30)/1000*2;
                    $dlina_diod = (($height >= $width) ? ($height -30) : ($width - 30))*2/1000;
                    return ['ploshad_vnesh' => $ploshad_vnesh,
                            'ploshad_vnut' => $ploshad_vnut,
                            'perimetr_vnesh' => $perimetr_vnesh,
                            'perimetr_vnut' => $perimetr_vnut,
                            'dlina_diod' => $dlina_diod,];
                    
                }

    }


    
    public function blockPower($dlinaDiodov, Materials $materials){
        if ($dlinaDiodov *12*1.3<=24 ){return $materials->blok24;}
        if ($dlinaDiodov *12*1.3>=24 && $dlinaDiodov *12*1.3 < 36){return $materials->blok36;}
        if ($dlinaDiodov *12*1.3>=36 && $dlinaDiodov *12*1.3 < 48){return $materials->blok48;}
        if ($dlinaDiodov *12*1.3>=48 && $dlinaDiodov *12*1.3 < 60){return $materials->blok60;}
        if ($dlinaDiodov *12*1.3>=60){ return 800;}
    }

    public function coef($vneshPlosh){
        
                if ( $vneshPlosh < 0.5)
                { return 1.8;};
                if ( $vneshPlosh >= 0.5 & $vneshPlosh <= 1)
                { return 1.75;};
                if ( $vneshPlosh > 1)
                { return 1.75;}

    }
      

    
    public function price_real($materials, $vneshPlosh){

        $price_sum = 0;
        $coef = $this->coef($vneshPlosh);

        foreach ($materials as $key => $price){
            if ($key == 'Кронштейны цанг'){$price[1] = $price[1]/$coef*1.3; }
            if ($key == 'Держатели верхние'){$price[1] = $price[1]/$coef*1.3; }
            if ($key == 'Фрезеровка'){$price[1] = $price[1]/$coef; }
            $price_sum = $price_sum + $price[0]*$price[1];

        };

            $real_price = $price_sum*$coef;

            if ($real_price % 1000 <= 100){
                $real_price = $real_price - $real_price % 1000 - 15;
            }

        return [round($real_price, 0), round($price_sum,0)] ;

    }







    













}

