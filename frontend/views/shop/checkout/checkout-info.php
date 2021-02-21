<?php
use shop\helpers\OrderHelper;
use shop\helpers\PriceHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
$this->title = 'Спасибо за заказ!';
?>
<div class="col-md-12">
    <p>Ваш заказ <strong>№<?php echo $order->id;?></strong> успешно оформлен.</p>
    <p>Мы отправили данные заказа на указанную Вами почту: <strong><?php echo $order->email;?></strong></p>
    <p>В ближайшее время наш менеджер свяжется с Вами по телефону или по e-mail и подтвердит заказ. </p>



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


</div>



