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
    //public $segment;
    public $krepl;
    public $storon;
    public $wight;
    public $pwight;
    public $height;
    public $phight;
    public $segment;
    public $posterOrGabarit;
    public $qty;
    public $size;
    



    public function rules(): array
    {
        return [
            [['category', 'krepl', 'storon', 'wight', 'pwight', 'height', 'phight','segment', 'posterOrGabarit', 'qty', 'size'], 'safe'],
           
        ];
    }
}