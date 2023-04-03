<?php

use yii\db\Migration;

class m230323_052421_add_characterisitcs_data extends Migration
{
    protected const TABLE = 'shop_characteristics';
    protected const DATA = [
        [
            'krepl',
            'Крепление',
            null,
            'string',
            0,
            null,
            '["Настенная", "Подвесная"]',
            1
        ],
        [
            'storon',
            'Количество сторон',
            null,
            'string',
            0,
            null,
            '["Односторонняя", "Двухсторонняя"]',
            2
        ],
        [
            'size',
            'Размер',
            null,
            'string',
            0,
            null,
            '[]',
            3
        ],
        [
            'wight',
            'Ширина',
            'мм',
            'integer',
            0,
            null,
            '[]',
            4
        ],
        [
            'height',
            'Высота',
            'мм',
            'integer',
            0,
            null,
            '[]',
            5
        ],
        [
            'pwight',
            'Ширина постера',
            'мм',
            'integer',
            0,
            null,
            '[]',
            6
        ],
        [
            'phight',
            'Высота постера',
            'мм',
            'integer',
            0,
            null,
            '[]',
            7
        ],
        [
            'thiknes',
            'Толщина',
            'мм',
            'integer',
            0,
            null,
            '[]',
            8
        ],
        [
            'power',
            'Мощнсть',
            'Вт',
            'integer',
            0,
            null,
            '[]',
            9
        ],
        [
            'voltage',
            'Напряжение питания',
            'мм',
            'integer',
            0,
            null,
            '[]',
            10
        ],
    ];
    public function safeUp()
    {
        $this->batchInsert(self::TABLE,
            [
                'slug',
                'name',
                'uom',
                'type',
                'required',
                'default',
                'variants_json',
                'sort',
            ], self::DATA);
    }

    public function safeDown()
    {
        $this->delete(self::TABLE);
    }

}
