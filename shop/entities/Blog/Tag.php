<?php
/**
 * Created by PhpStorm.
 * User: СамецМужчина
 * Date: 14.06.2020
 * Time: 14:22
 */
namespace shop\entities\Blog;

use yii\db\ActiveRecord;


class Tag extends ActiveRecord
{

    public static function create($name, $slug)
    {
        $tag = new static();
        $tag->name = $name;
        $tag->slug = $slug;
        return $tag;
    }


    public function edit($name, $slug): void
    {
        $this->name = $name;
        $this->slug = $slug;
    }

    public static function tableName(): string
    {
        return '{{%blog_tags}}';
    }
}