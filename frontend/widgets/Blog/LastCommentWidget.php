<?php
/**
 * Created by PhpStorm.
 * User: СамецМужчина
 * Date: 19.07.2020
 * Time: 20:07
 */

namespace frontend\widgets\Blog;

use shop\readModels\Blog\PostReadRepository;
use yii\base\Widget;
use shop\entities\Blog\Post\Comment;


class LastCommentWidget extends Widget
{

    public $limit;
    public $repository;

    public function __construct($config = [])
    {
        parent::__construct($config);

    }

    public function run(): string
    {
        return $this->render('last-comments', [
            'comments' =>  Comment::find()->with(['user'])->orderBy(['id' => SORT_DESC])->limit($this->limit)->all()
        ]);
    }

}