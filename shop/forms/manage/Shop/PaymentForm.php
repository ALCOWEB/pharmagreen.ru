<?php
/**
 * Created by PhpStorm.
 * User: СамецМужчина
 * Date: 19.09.2020
 * Time: 15:22
 */

namespace shop\forms\manage\Shop;
use shop\entities\Shop\PaymentMethod;
use yii\base\Model;

class PaymentForm extends Model
{
    public $name;
    public function __construct(PaymentMethod $method = null, $config = [])
    {
        if ($method) {
            $this->name = $method->name;
        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['name'], 'required'],

        ];
    }

}