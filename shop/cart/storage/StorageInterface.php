<?php
/**
 * Created by PhpStorm.
 * User: СамецМужчина
 * Date: 20.05.2020
 * Time: 0:31
 */
namespace shop\cart\storage;
use shop\cart\CartItem;


interface StorageInterface
{
    /**
     * @return CartItem[]
     */
    public function load(): array;

    /**
     * @param CartItem[] $items
     */
    public function save(array $items): void;
}