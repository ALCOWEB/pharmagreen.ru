<?php
namespace shop\entities\Shop\Product;
use yii\db\ActiveRecord;
use shop\entities\Shop\Product\Product;
use shop\entities\User\User;
use shop\entities\User\Photo;
use yii\db\ActiveQuery;
/**
 * @property int $id
 * @property int $created_at
 * @property int $user_id
 * @property int $vote
 * @property string $text
 * @property bool $active
 */
class Review extends ActiveRecord
{
    const STATUS_DRAFT = 0;
    const STATUS_ACTIVE = 1;



    public static function create($userId, int $vote, string $text): self
    {
        $review = new static();
        $review->user_id = $userId;
        $review->vote = $vote;
        $review->text = $text;
        $review->created_at = time();
        $review->active = false;
        return $review;
    }
    public function edit($vote, $text): void
    {
        $this->vote = $vote;
        $this->text = $text;
    }
    public function activate(): void
    {
        $this->active = true;
    }
    public function draft(): void
    {
        $this->active = false;
    }
    public function isActive(): bool
    {
        if ($this->active == 1){return true;}
        if ($this->active == 0){return false;}

    }
    public function getRating()
    {
        return $this->vote;
    }
    public function isIdEqualTo($id): bool
    {
        return $this->id == $id;
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function getPhoto()
    {
        return $this->hasOne(Photo::class, ['user_id' => 'user_id']);
    }

    public function getProduct(): ActiveQuery
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }
    public static function tableName(): string
    {
        return '{{%shop_reviews}}';
    }


}