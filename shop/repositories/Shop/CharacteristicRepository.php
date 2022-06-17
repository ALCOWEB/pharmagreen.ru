<?php
namespace shop\repositories\Shop;
use shop\entities\Shop\Characteristic;
use shop\repositories\NotFoundException;
use yii\helpers\ArrayHelper;
class CharacteristicRepository
{
    public function get($id): Characteristic
    {
        if (!$characteristic = Characteristic::findOne($id)) {
            throw new NotFoundException('Characteristic is not found.');
        }
        return $characteristic;
    }

    public function getIds()
    {
        $characteristics = ArrayHelper::map(Characteristic::find()->select(['id', 'name'])->asArray()->all(), 'name', 'id');
        
        return $characteristics;
    }

    public function getByName($name): Characteristic
    {
        if (!$characteristic = Characteristic::find()->where(['name' => $name])->one()) {
            throw new NotFoundException('Characteristic is not found.');
        }
        return $characteristic;
    }
    public function save(Characteristic $characteristic): void
    {
        if (!$characteristic->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }
    public function remove(Characteristic $characteristic): void
    {
        if (!$characteristic->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}