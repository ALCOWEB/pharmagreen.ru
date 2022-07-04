<?php

namespace shop\forms\manage\Shop\Product;

use yii\base\Model;

class ProductDescriptionBatch  extends Model
{

    public $description;
    public $short_desc;



    public function rules(): array
    {
        return [
            ['description', 'string'],
            ['short_desc', 'string'],
        ];
    }

}
