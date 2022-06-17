<?php
namespace shop\repositories\Shop;
use shop\entities\Shop\Materials;
use shop\repositories\NotFoundException;
class MaterialsRepository
{
    public function get($id): Materials
    {
        if (!$materials = Materials::findOne($id)) {
            throw new NotFoundException('Product is not found.');
        }
        return $materials;
    }

    public function getActive(): Materials
    {
        if (!$materials = Materials::find()->where(['status' => Materials::ACTIVE])->one()) {
            throw new NotFoundException('Product is not found.');
        }
        return $materials;
    }



}