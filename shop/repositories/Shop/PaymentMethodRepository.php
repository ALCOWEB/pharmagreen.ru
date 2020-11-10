<?php
/**
 * Created by PhpStorm.
 * User: СамецМужчина
 * Date: 19.09.2020
 * Time: 15:56
 */

namespace shop\repositories\Shop;
use shop\entities\Shop\PaymentMethod;

class PaymentMethodRepository
{
    public function get($id): PaymentMethod
    {
        if (!$method = PaymentMethod::findOne($id)) {
            throw new NotFoundException('DeliveryMethod is not found.');
        }
        return $method;
    }

    public function findByName($name): ?PaymentMethod
    {
        return PaymentMethod::findOne(['name' => $name]);
    }

    public function save(PaymentMethod $method): void
    {
        if (!$method->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(PaymentMethod $method): void
    {
        if (!$method->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}