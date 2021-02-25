<?php
use yii\helpers\Html;
use shop\helpers\OrderHelper;
use yii\helpers\Url;
use shop\helpers\PriceHelper;
use shop\entities\Shop\Product\Product;
/* @var $this yii\web\View */
/* @var $order shop\entities\Shop\Order\Order */

/* @var $user \shop\entities\User\User */
$confirmLink = Yii::$app->urlManager->createAbsoluteUrl(['auth/signup/confirm', 'token' => $user->email_confirm_token]);
$cabinrtUrl = Yii::$app->urlManager->createAbsoluteUrl(['cabinet/order/view', 'id' => $order->id]);
?>
<div class="password-reset">
    <?php if ($user->email_confirm_token): ?>
        <p>Пройдите по ссылке, чтобы подтвердить вашу электронную почту:</p>
        <p><?= Html::a(Html::encode($confirmLink), $confirmLink) ?></p>
    <?php endif; ?>
    <?php if ($password): ?>
        <p>Ваш пароль автоматически созданный при регистрации: <?= $password ?></p>

    <?php endif; ?>
    <strong>Информация о заказе в Pharmagreen.ru</strong>
    <p>Здравствуйте! Вас приветствует Интернет-магазин Pharmagreen.ru</p>
    <p>Недавно Вы сделали заказ в нашем магазине. Информация о Вашем заказе представлена ниже.</p>
    <p>Посмотреть статус заказа и оплатить его онлай можно перейдя в <?= Html::a('личный кабинет', $cabinrtUrl) ?>личный кабинет</p>

    <table style="border: 1px solid #dee2e6; margin-bottom: 1rem; color: #212529; border-collapse: collapse;">
        <tbody>
        <tr style="background-color: #e9ecef;">
            <th style="border: 1px solid #dee2e6; padding: 5px; text-align:left">№</th>
            <td  style="border: 1px solid #dee2e6; padding: 5px;"><?= $order->id ?></td>
        </tr>
        <tr>
            <th  style="border: 1px solid #dee2e6; padding: 5px; text-align:left">Создан</th>
            <td  style="border: 1px solid #dee2e6; padding: 5px;"><?= Yii::$app->formatter->asDatetime($order->created_at) ?> </td>
        </tr>
        <tr style="background-color: #e9ecef;">
            <th  style="border: 1px solid #dee2e6; padding: 5px; text-align:left">Статус заказа</th>
            <td  style="border: 1px solid #dee2e6; padding: 5px;"><?= OrderHelper::statusLabel($order->current_status) ?></td>
        </tr>
        <tr>
            <th  style="border: 1px solid #dee2e6; padding: 5px; text-align:left">Метод оплаты</th>
            <td  style="border: 1px solid #dee2e6; padding: 5px;"><?= $order->payment_method ?></td>
        </tr>
        <tr style="background-color: #e9ecef;">
            <th  style="border: 1px solid #dee2e6; padding: 5px; text-align:left">Метод доставки</th>
            <td  style="border: 1px solid #dee2e6; padding: 5px;"><?= $order->delivery_method_name ?></td>
        </tr>
        <tr>
            <th  style="border: 1px solid #dee2e6; padding: 5px; text-align:left">Адрес</th>
            <td  style="border: 1px solid #dee2e6; padding: 5px;"><?= $order->deliveryData->address ?></td>
        </tr>
        <tr style="background-color: #e9ecef;">
            <th  style="border: 1px solid #dee2e6; padding: 5px; text-align:left">Индекс</th>
            <td  style="border: 1px solid #dee2e6; padding: 5px;"><?= $order->deliveryData->index ?></td>
        </tr>
        <tr>
            <th  style="border: 1px solid #dee2e6; padding: 5px; text-align:left">Цена</th>
            <td  style="border: 1px solid #dee2e6; padding: 5px;"><?= $order->cost ?></td>
        </tr>
        <tr style="background-color: #e9ecef;">
            <th  style="border: 1px solid #dee2e6; padding: 5px; text-align:left">Заметка</th>
            <td  style="border: 1px solid #dee2e6; padding: 5px;"><?php echo ($order->note) ? $order->note : '' ?></td>
        </tr>
        </tbody>
    </table>

    <div class="table-responsive" style="display: block;width: 100%;overflow-x: auto;">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th class="text-left" style="background-color: #40A944; border: 1px solid #dee2e6; padding: 5px; text-align:left">Название продукта</th>
                <th class="text-left" style="background-color: #40A944; border: 1px solid #dee2e6; padding: 5px; text-align:left">Модель</th>
                <th class="text-left" style="background-color: #40A944; border: 1px solid #dee2e6; padding: 5px; text-align:left">Кол-во</th>
                <th class="text-right" style="background-color: #40A944; border: 1px solid #dee2e6; padding: 5px; text-align:left">Цена</th>
                <th class="text-right" style="background-color: #40A944; border: 1px solid #dee2e6; padding: 5px; text-align:left">Итого</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($order->items as $item): ?>
                <?php $product = Product::findOne($item->product_id) ?>
                <?php $productUrl = Yii::$app->urlManager->createAbsoluteUrl(['shop/catalog/product', 'id' => $product->id]); ?>

                <tr>
                    <td class="text-left" style="border-right: 1px solid #ededed;font-weight: 500;text-transform: capitalize;font-size: 14px;text-align: center;min-width: 150px;">
                        <?= Html::encode($item->product_code) ?><br />
                        <?=
                        Html::a(Html::encode($item->product_name), $productUrl) ?>
                    </td>
                    <td class="text-left" style="border-right: 1px solid #ededed;font-weight: 500;text-transform: capitalize;font-size: 14px;text-align: center;min-width: 150px;">
                        <?= Html::encode($item->modification_code) ?><br />
                        <?= Html::encode($item->modification_name) ?>
                    </td>
                    <td class="text-left" style="border-right: 1px solid #ededed;font-weight: 500;text-transform: capitalize;font-size: 14px;text-align: center;min-width: 150px;">
                        <?= $item->quantity ?>
                    </td>
                    <td class="text-right" style="border-right: 1px solid #ededed;font-weight: 500;text-transform: capitalize;font-size: 14px;text-align: center;min-width: 150px;"><?= $item->price ?> Рублей</td>
                    <td class="text-right" style="border-right: 1px solid #ededed;font-weight: 500;text-transform: capitalize;font-size: 14px;text-align: center;min-width: 150px;"><?= $item->getCost()?> Рублей</td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php if ($order->canBePaid()): ?>

        <div style="margin-left:50px">
            <h2>Оплатить онлайн</h2>

            <?= Html::a('Оплатить через Робокассу', Yii::$app->urlManager->createAbsoluteUrl(['payment/robokassa/invoice', 'id' => $order->id]), ['class' => 'btn btn-success']) ?>
        </div>
    <?php endif; ?>

</div>