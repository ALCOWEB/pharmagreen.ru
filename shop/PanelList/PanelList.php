<?php
namespace shop\PanelList;
class PanelList{

   public $sizes = [
        'A4+' => '210x297',
        'A3+' => '297x420',
        'A2+' => '420x594',
        'A1+' => '594x841',
        'A0+' => '841x1189',
        'AA' => '990x1500',
        '2AA' => '1200x1800',
   ];

   public function crystalDesc($size){
    return [
      'short-desc' =>  "Кристалайтами называют тонкие световые панели для рекламы, они изготвлены из акрила, подсветка осуществляется светодиодной лентой с торцов матрицы. Отличительной особенностью кристалайтов является ореол света, который исходит из торцов рамки. Такая рекламная панель выглядит очень изящно и стройно.",
      'desc' =>  "В световых панелях кристалайт серии стандарт используются светорассеивающие матрицы шириной 5 мм. Благодаря такой толщине панель светит ярче (3000 lux для панели размером А1+). Фаска по периметру рамки отсутствует. В двусторонних панелях этой серии используется одна матрица и один контур засветки.
      ",
      'title' => 'Рекламная световая панель Кристалайт | '.$size.' - 7500 рублей.',
      'photos' => '',
    ];
   }

  

   

   public function makeCrystalNasten(){
     $panels = [];
     foreach($this->sizes as $key => $val){
        $size = explode('x', $val);
       $panels[] = [
        'brand' => "ООО \"Каллиграф\"", 
        'code' => 'CR-N-'.$key, 
        'name' => 'Кристалайт настенный '.$key, 
        'category' => 'Кристалайт',
        'application methods' => '',
        'short-desc' => '',
        'description' =>  '',
        'weight' => 1400,
        'qty' => 200,
        'price-new' => 2785,
        'price-old' => 3350,
        'tags' => ['кристалайт', 'cветовая панель' , $key],
        'characteristics' => [
            'Потребляемая мощность' => 7,
            'Напряжение питания' => 12,
            'Размер' => $key,
            'Количество сторон' => 'Односторонняя',
            'Вариант крепления' => 'Настенная',
            'Ценовой сегмент' => 'Стандарт',
            'Ширина' => $size[0]+100,
            'Высота' => $size[1]+100,
            'Ширина постера' => $size[0],
            'Высота постера' => $size[1],
        ],
        'SEO' => [
            'title' => '',
            'description' => '',
          
        ]
      
        ];
     }
     return $panels;
   }


   public function makeCrystalPodves1s(){
    $panels = [];
    foreach($this->sizes as $key => $val){
       $size = explode('x', $val);
      $panels[] = [
        'brand' => "ООО \"Каллиграф\"", 
        'code' => 'CR-P1S-'.$key, 
        'name' => 'Кристалайт подвесной односторонний '.$key, 
        'category' => 'Кристалайт',
        'application methods' => '',
        'short-desc' => 
               '',
        'description' => 
               '',
        'weight' => 1400,
        'qty' => 200,
        'price-new' => 2785,
        'price-old' => 3350,
        'tags' => ['кристалайт', 'cветовая панель' , $key],
        'characteristics' => [
            'Потребляемая мощность' => 7,
            'Напряжение питания' => 12,
            'Размер' => $key,
            'Количество сторон' => 'Односторонняя',
            'Вариант крепления' => 'Подвесная',
            'Ценовой сегмент' => 'Стандарт',
            'Ширина' => $size[0]+100,
            'Высота' => $size[1]+100,
            'Ширина постера' => $size[0],
            'Высота постера' => $size[1],
        ],
        'SEO' => [
            'title' => '',
            'description' => '',
          
        ]
      ];
       
    }
    return $panels;
  }


  

  public function makeCrystalPodves2s(){
    $panels = [];
    foreach($this->sizes as $key => $val){
       $size = explode('x', $val);
      $panels[] = [
        'brand' => "ООО \"Каллиграф\"", 
        'code' => 'CR-P2S-'.$key, 
        'name' => 'Кристалайт подвесной двухсторонний '.$key, 
        'category' => 'Кристалайт',
        'application methods' => '',
        'short-desc' => 
               '',
        'description' => 
               '',
        'weight' => 1400,
        'qty' => 200,
        'price-new' => 2785,
        'price-old' => 3350,
        'tags' => ['кристалайт', 'cветовая панель' , $key],
        'characteristics' => [
            'Потребляемая мощность' => 7,
            'Напряжение питания' => 12,
            'Размер' => $key,
            'Количество сторон' => 'Двухсторонняя',
            'Вариант крепления' => 'Подвесная',
            'Ценовой сегмент' => 'Стандарт',
            'Ширина' => $size[0]+100,
            'Высота' => $size[1]+100,
            'Ширина постера' => $size[0],
            'Высота постера' => $size[1],
        ],
        'modification' => [
          'code' => 'CR-P2S-'.$key.'-2M',
          'name' => 'Две матрицы со светоблокирущим слоем',
          'price' => 1000,
          'qty' => 200
        ],
        'SEO' => [
            'title' => '',
            'description' => '',
          
        ]
      ];
       
    }
    return $panels;
  }


  

  public function makeFramelNasten(){
    $panels = [];
    foreach($this->sizes as $key => $val){
       $size = explode('x', $val);
      $panels[] = [
        'brand' => "ООО \"Каллиграф\"", 
        'code' => 'FR-N-'.$key, 
        'name' => 'Фреймлайт настенный '.$key, 
        'category' => 'Фреймлайт',
        'application methods' => '',
        'short-desc' => 
               '',
        'description' => 
               '',
        'weight' => 1400,
        'qty' => 200,
        'price-new' => 2785,
        'price-old' => 3350,
        'tags' => ['фреймлайт', 'cветовая панель' , $key],
        'characteristics' => [
            'Потребляемая мощность' => 7,
            'Напряжение питания' => 12,
            'Размер' => $key,
            'Количество сторон' => 'Односторонняя',
            'Вариант крепления' => 'Настенная',
            'Ценовой сегмент' => 'Стандарт',
            'Ширина' => $size[0]+30,
            'Высота' => $size[1]+30,
            'Ширина постера' => $size[0],
            'Высота постера' => $size[1],
        ],
        'SEO' => [
            'title' => '',
            'description' => '',
          
        ]
      ];
       
    }
    return $panels;
  }


  public function makeFramelPodves1s(){
    $panels = [];
    foreach($this->sizes as $key => $val){
       $size = explode('x', $val);
      $panels[] = [
        'brand' => "ООО \"Каллиграф\"", 
        'code' => 'FR-P1S-'.$key, 
        'name' => 'Фреймлайт подвесной односторонний '.$key, 
        'category' => 'Фреймлайт',
        'application methods' => '',
        'short-desc' => 
               '',
        'description' => 
               '',
        'weight' => 1400,
        'qty' => 200,
        'price-new' => 2785,
        'price-old' => 3350,
        'tags' => ['фреймлайт', 'cветовая панель' , $key],
        'characteristics' => [
            'Потребляемая мощность' => 7,
            'Напряжение питания' => 12,
            'Размер' => $key,
            'Количество сторон' => 'Односторонняя',
            'Вариант крепления' => 'Подвесная',
            'Ценовой сегмент' => 'Стандарт',
            'Ширина' => $size[0]+30,
            'Высота' => $size[1]+30,
            'Ширина постера' => $size[0],
            'Высота постера' => $size[1],
        ],
        'SEO' => [
            'title' => '',
            'description' => '',
          
        ]
      ];
       
    }
    return $panels;
  }


  public function makeFramelPodves2s(){
    $panels = [];
    foreach($this->sizes as $key => $val){
       $size = explode('x', $val);
      $panels[] = [
        'brand' => "ООО \"Каллиграф\"", 
        'code' => 'FR-P2S-'.$key, 
        'name' => 'Фреймлайт подвесной двухсторонний '.$key, 
        'category' => 'Фреймлайт',
        'application methods' => '',
        'short-desc' => 
               '',
        'description' => 
               '',
        'weight' => 1400,
        'qty' => 200,
        'price-new' => 2785,
        'price-old' => 3350,
        'tags' => ['фреймлайт', 'cветовая панель' , $key],
        'characteristics' => [
            'Потребляемая мощность' => 7,
            'Напряжение питания' => 12,
            'Размер' => $key,
            'Количество сторон' => 'Двухсторонняя',
            'Вариант крепления' => 'Подвесная',
            'Ценовой сегмент' => 'Стандарт',
            'Ширина' => $size[0]+30,
            'Высота' => $size[1]+30,
            'Ширина постера' => $size[0],
            'Высота постера' => $size[1],
        ],
        'modification' => [
          'code' => 'FR-P2S-'.$key.'-2M',
          'name' => 'Две матрицы со светоблокирущим слоем',
          'price' => 1000,
          'qty' => 200
        ],
        'SEO' => [
            'title' => '',
            'description' => '',
          
        ]
      ];
       
    }
    return $panels;
  }


  public function makeMagnetNasten(){
    $panels = [];
    foreach($this->sizes as $key => $val){
       $size = explode('x', $val);
      $panels[] = [
        'brand' => "ООО \"Каллиграф\"", 
        'code' => 'MG-N-'.$key, 
        'name' => 'Магнетик настенный '.$key, 
        'category' => 'Магнетик',
        'application methods' => '',
        'short-desc' => 
               '',
        'description' => 
               '',
        'weight' => 1400,
        'qty' => 200,
        'price-new' => 2785,
        'price-old' => 3350,
        'tags' => ['магнетик', 'cветовая панель' , $key],
        'characteristics' => [
            'Потребляемая мощность' => 7,
            'Напряжение питания' => 12,
            'Размер' => $key,
            'Количество сторон' => 'Односторонняя',
            'Вариант крепления' => 'Настенная',
            'Ценовой сегмент' => 'Стандарт',
            'Ширина' => $size[0]+30,
            'Высота' => $size[1]+30,
            'Ширина постера' => $size[0],
            'Высота постера' => $size[1],
        ],
        'SEO' => [
            'title' => '',
            'description' => '',
          
        ]
      ];
       
    }
    return $panels;
  }

  public function makeMagnetPodves1s(){
    $panels = [];
    foreach($this->sizes as $key => $val){
       $size = explode('x', $val);
      $panels[] = [
        'brand' => "ООО \"Каллиграф\"", 
        'code' => 'MG-P1S-'.$key, 
        'name' => 'Магнетик подвесной односторонний '.$key, 
        'category' => 'Магнетик',
        'application methods' => '',
        'short-desc' => 
               '',
        'description' => 
               '',
        'weight' => 1400,
        'qty' => 200,
        'price-new' => 2785,
        'price-old' => 3350,
        'tags' => ['магнетик', 'cветовая панель' , $key],
        'characteristics' => [
            'Потребляемая мощность' => 7,
            'Напряжение питания' => 12,
            'Размер' => $key,
            'Количество сторон' => 'Односторонняя',
            'Вариант крепления' => 'Подвесная',
            'Ценовой сегмент' => 'Стандарт',
            'Ширина' => $size[0]+30,
            'Высота' => $size[1]+30,
            'Ширина постера' => $size[0],
            'Высота постера' => $size[1],
        ],
        'SEO' => [
            'title' => '',
            'description' => '',
          
        ]
      ];
       
    }
    return $panels;
  }


  public function makeMagnetPodves2s(){
    $panels = [];
    foreach($this->sizes as $key => $val){
       $size = explode('x', $val);
      $panels[] = [
        'brand' => "ООО \"Каллиграф\"", 
        'code' => 'MG-P2S-'.$key, 
        'name' => 'Магнетик подвесной двухсторонний '.$key, 
        'category' => 'Магнетик',
        'application methods' => '',
        'short-desc' => 
               '',
        'description' => 
               '',
        'weight' => 1400,
        'qty' => 200,
        'price-new' => 2785,
        'price-old' => 3350,
        'tags' => ['магнетик', 'cветовая панель' , $key],
        'characteristics' => [
            'Потребляемая мощность' => 7,
            'Напряжение питания' => 12,
            'Размер' => $key,
            'Количество сторон' => 'Двухсторонняя',
            'Вариант крепления' => 'Подвесная',
            'Ценовой сегмент' => 'Стандарт',
            'Ширина' => $size[0]+30,
            'Высота' => $size[1]+30,
            'Ширина постера' => $size[0],
            'Высота постера' => $size[1],
        ],
        'modification' => [
          'code' => 'MG-P2S-'.$key.'-2M',
          'name' => 'Две матрицы со светоблокирущим слоем',
          'price' => 1000,
          'qty' => 200
        ],
        'SEO' => [
            'title' => '',
            'description' => '',
          
        ]
      ];
       
    }
    return $panels;
  }
    public $panelList = [];


}
