<?php
namespace shop\forms\manage\Shop\Product;
use shop\entities\Shop\Product\Product;
use shop\forms\manage\MetaForm;
use yii\base\Model;
/**
 * @property MetaForm $meta
 * @property CategoriesForm $categories
 * @property TagsForm $tags
 * @property ValueForm[] $values
 */
class PanelCalcForm extends Model
{
    public $category;
    public $segment;
    public $krepl;
    public $storon;




    public function rules(): array
    {
        return [
            [['new'], 'required'],
            [['old', 'new'], 'integer', 'min' => 0],
        ];
    }
}