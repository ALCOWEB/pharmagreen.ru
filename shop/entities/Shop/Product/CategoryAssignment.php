<?php
namespace shop\entities\Shop\Product;
use yii\db\ActiveRecord;
/**
 * @property integer $product_id;
 * @property integer $category_id;
 * 3 4:13
 */
class CategoryAssignment extends ActiveRecord
{
    public static function create($categoryId): self
    {
        $assignment = new static();
        $assignment->category_id = $categoryId;
        return $assignment;
    }
    public function isForCategory($id): bool  // Привязан ли товар с тсакой категорий к продукту из промежуточной таблицы
    {
        return $this->category_id == $id;
    }
    public static function tableName(): string
    {
        return '{{%shop_category_assignments}}';
    }
}