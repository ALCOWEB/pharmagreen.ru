<?php
/**
 * Created by PhpStorm.
 * User: СамецМужчина
 * Date: 20.07.2020
 * Time: 21:09
 */

namespace frontend\widgets\Blog;

use shop\repositories\Blog\TagRepository;
use yii\base\Widget;



class TagBlogWidget extends Widget
{
    public $limit;
    public $repository;


    public function __construct(TagRepository $repository, $config = [])
    {
        parent::__construct($config);
        $this->repository = $repository;
    }


    public function run(): string
    {
        return $this->render('tag-blog', [
            'postWithTags' =>  $this->repository->getAll()
        ]);
    }
}