<?php
namespace shop\entities\Shop;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use yii\db\ActiveRecord;
use yii\helpers\Json;
/**
 * @property integer $id
 * @property string $name
 * @property string $type
 * @property string $required
 * @property string $default
 * @property array $variants
 * @property integer $sort
 */
class Characteristic extends ActiveRecord  //3 3:45
{
    const TYPE_STRING = 'string';
    const TYPE_INTEGER = 'integer';
    const TYPE_FLOAT = 'float';
    public $variants;

    public function __toString(): string
    {
        return $this->name;
    }

    public static function create($name, $slug, $type, $uom, $required, $default, array $variants, $sort): self
    {
        $object = new static();
        $object->name = $name;
        $object->slug = $slug;
        $object->type = $type;
        $object->uom = $uom;
        $object->required = $required;
        $object->default = $default;
        $object->variants = $variants;
        $object->sort = $sort;
        return $object;
    }
    public function edit($name, $slug, $type, $uom, $required, $default, array $variants, $sort, $categories): void
    {
        $this->name = $name;
        $this->slug = $slug;
        $this->type = $type;
        $this->uom = $uom;
        $this->required = $required;
        $this->default = $default;
        $this->variants = $variants;
        $this->sort = $sort;
        $this->assignCategory(Category::find()->where(['in', 'id', $categories])->all());
    }
    public function isSelect(): bool
    {
        return count($this->variants) > 0;
    }
    public static function tableName(): string
    {
        return '{{%shop_characteristics}}';
    }

    public function getCategories()
    {
        return $this->hasMany(Category::class, ['id' => 'category_id'])
            ->viaTable('shop_characteristic_category', ['characteristic_id' => 'id']);
    }

    public function assignCategory($category){
        $this->categories = $category;
    }

    public function afterFind(): void
    {
        $this->variants = array_filter(Json::decode($this->getAttribute('variants_json')));
        parent::afterFind();
    }
    public function beforeSave($insert): bool
    {
        $this->setAttribute('variants_json', Json::encode(array_filter($this->variants)));
        return parent::beforeSave($insert);
    }

    public function isString(): bool
    {
        return $this->type === self::TYPE_STRING;
    }
    public function isInteger(): bool
    {
        return $this->type === self::TYPE_INTEGER;
    }
    public function isFloat(): bool
    {
        return $this->type === self::TYPE_FLOAT;
    }

    public function behaviors(): array
    {
        return [
            [
                'class' => SaveRelationsBehavior::className(),
                'relations' => ['categories'],
            ],
        ];
    }
}
