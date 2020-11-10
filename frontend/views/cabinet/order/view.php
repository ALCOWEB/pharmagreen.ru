<?php

use shop\helpers\OrderHelper;
use shop\helpers\PriceHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $order shop\entities\Shop\Order\Order */

$this->title = 'Закзаз № ' . $order->id;
$this->params['breadcrumbs'][] = ['label' => 'Cabinet', 'url' => ['cabinet/default/index']];
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
?>




    <?= DetailView::widget([
        'model' => $order,
        'attributes' => [
            ['attribute' => 'id',
                'label' => '№'],
            [
                'attribute' => 'created_at',
                'value' => Yii::$app->formatter->asDatetime($order->created_at),
                'format' => 'raw',
                'label' => 'Создан'
            ],
            [
                'attribute' => 'current_status',
                'value' => OrderHelper::statusLabel($order->current_status),
                'format' => 'raw',
                'label' => 'Статус заказа'
            ],
            ['attribute' => 'payment_method',
                'label' => 'Метод оплаты'],
            ['attribute' => 'delivery_method_name',
                'label' => 'Метод доставки'],
            ['attribute' => 'deliveryData.address',
                'label' => 'Адрес'],
            ['attribute' => 'deliveryData.index',
                'label' => 'Индекс'],
            ['attribute' => 'cost',
                'label' => 'Цена'],
            ['attribute' => 'note',
                'format' => 'ntext',
                'label' => 'Заметка'],

        ],
    ]) ?>


</br>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th class="text-left">Фото</th>
                <th class="text-left">Название продукта</th>
                <th class="text-left">Модель</th>
                <th class="text-left">Кол-во</th>
                <th class="text-right">Цена</th>
                <th class="text-right">Итого</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($order->items as $item): ?>
                <?php $product = \shop\entities\Shop\Product\Product::findOne($item->product_id) ?>
                <tr>
                    <td class="product_thumb">   <a href="<?= Url::to(['/shop/catalog/product', 'id' => $product->id]) ?>">

                            <?php if ($product->mainPhoto): ?>
                                <img src="<?= $product->mainPhoto->getThumbFileUrl('file', 'admin') ?>" alt="" class="" />
                            <?php endif; ?>
                        </a></td>
                    <td class="text-left">
                        <?= Html::encode($item->product_code) ?><br />
                        <?=
                        Html::a(Html::encode($item->product_name), ['shop/catalog/product/', 'id' => $item->product_id]) ?>
                    </td>
                    <td class="text-left">
                        <?= Html::encode($item->modification_code) ?><br />
                        <?= Html::encode($item->modification_name) ?>
                    </td>
                    <td class="text-left">
                        <?= $item->quantity ?>
                    </td>
                    <td class="text-right"><?= PriceHelper::format($item->price) ?></td>
                    <td class="text-right"><?= PriceHelper::format($item->getCost()) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>


    <div class="box">
        <h2>История заказа</h2>
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-bordered" style="margin-bottom: 0">
                    <thead>
                    <tr>
                        <th class="text-left">Дата</th>
                        <th class="text-left">Статус заказа</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($order->statuses as $status): ?>

                        <tr>
                            <td class="text-left">

                                <?= Yii::$app->formatter->asDatetime($status->created_at) ?>
                            </td>
                            <td class="text-left">
                                <?= OrderHelper::statusLabel($status->value) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php if ($order->canBePaid()): ?>

    <div style="margin-left:50px">
        <h2>Оплатить онлайн</h2>

        <?= Html::a('Оплатить через Робокассу', ['/payment/robokassa/invoice', 'id' => $order->id], ['class' => 'btn btn-success']) ?>
    </div>
<?php endif; ?>

</br>