<?php
namespace shop\services\manage\Shop;
use shop\entities\Shop\Category;
use shop\entities\Shop\Characteristic;
use shop\forms\manage\Shop\CharacteristicForm;
use shop\repositories\Shop\CharacteristicRepository;
class CharacteristicManageService
{
    private $characteristics;
    public function __construct(CharacteristicRepository $characteristics)
    {
        $this->characteristics = $characteristics;
    }
    public function create(CharacteristicForm $form): Characteristic
    {
        $characteristic = Characteristic::create(
            $form->name,
            $form->slug,
            $form->type,
            $form->uom,
            $form->required,
            $form->default,
            $form->variants,
            $form->sort
        );
        $this->characteristics->save($characteristic);
        return $characteristic;
    }
    public function edit($id, CharacteristicForm $form): void
    {
        $characteristic = $this->characteristics->get($id);
        $characteristic->edit(
            $form->name,
            $form->slug,
            $form->type,
            $form->uom,
            $form->required,
            $form->default,
            $form->variants,
            $form->sort
        );
        $characteristic->assignCategory(Category::find()->where(['in', 'id', [2,4]])->all());
        $this->characteristics->save($characteristic);
    }
    public function remove($id): void
    {
        $characteristic = $this->characteristics->get($id);
        $this->characteristics->remove($characteristic);
    }
}