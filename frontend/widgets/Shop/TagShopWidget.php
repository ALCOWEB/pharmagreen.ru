<?php
/**
 * Created by PhpStorm.
 * User: СамецМужчина
 * Date: 20.07.2020
 * Time: 21:09
 */

namespace frontend\widgets\shop;

use     shop\repositories\Shop\TagRepository;
use yii\base\Widget;



class TagShopWidget extends Widget
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
        return $this->render('tag-shop', [
            'tags' =>  $this->repository->getAll()
        ]);
    }
}