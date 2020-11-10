<?php

namespace shop\entities\Shop\Order;

class CustomerData
{
    public $phone;
    public $first_name;
    public $last_name;
    public $email;


    public function __construct($phone, $first_name, $last_name, $email)
    {
        $this->phone = $phone;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
    }
}