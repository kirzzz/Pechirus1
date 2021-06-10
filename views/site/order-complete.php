<?php
/* @var $this yii\web\View */
/* @var $order Orders */

use app\models\Orders;
use yii\helpers\Url;

$this->title = 'Pechirus: Подтверждение заказа';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="breadcrumb-area breadcrumb-mt breadcrumb-ptb-2">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <h2>Корзина</h2>
            <ul>
                <li>
                    <a href="<?= Url::toRoute(['site/index'])?>">Главная</a>
                </li>
                <li><span> > </span></li>
                <li class="active">Подтверждение заказа</li>
            </ul>
        </div>
    </div>
</div>
<div class="cart-check-order-link-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 ml-auto mr-auto">
                <div class="cart-check-order-link">
                    <a href="<?= Url::toRoute(['site/basket'])?>">Корзина</a>
                    <a href="<?= Url::toRoute(['site/order'])?>">Оформление заказа</a>
                    <a class="active">Спасибо за заказ</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="order-complete-area bg-gray pt-160 pb-160">
    <div class="container">
        <?php if(!empty($order)):?>
        <?php if(!Yii::$app->request->isPost):?><div class="order-complete-title">
            <h3>Спасибо за заказ! Он будет рассмотрен модератором в кротчайшие сроки</h3>
        </div><?php endif; ?>
        <div class="order-product-details">
            <div class="table-content table-responsive">
                <table>
                    <thead>
                    <tr>
                        <th>№ Заказа</th>
                        <th>Дата</th>
                        <th>Сумма</th>
                        <th>Вид платежа</th>
                        <th>Статус</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><?= $order->article ?></td>
                        <td><?= date('d.m.y H:i:s',$order->created_at) ?></td>
                        <td>&#8381;<?= $order->price ?></td>
                        <td><?= Orders::TYPE_OF_PAYMENT[array_search($order->payment,array_column(Orders::TYPE_OF_PAYMENT,'id'))]['name'] . ' ' . Orders::TYPE_OF_PAYMENT[array_search($order->payment,array_column(Orders::TYPE_OF_PAYMENT,'id'))]['name-2'] ?></td>
                        <td><?= Orders::STATUS_DESCRIPTION[$order->status] ?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php if(!Yii::$app->request->isPost and !empty($order)):

    ?>
<script type="text/javascript">
    window.dataLayer = window.dataLayer || [];
    dataLayer.push({
        "ecommerce": {
            "purchase": {
                "actionField": {
                    "id" : "<?= $order->article ?>"
                },
                "products": [
                    <?php
                        $products = json_decode($order->productInfo,true);
                        foreach ($products as $product):
                        $item = \app\models\Product::findIdentity($product['idProduct']);
                        ?>
                    {
                        "id": "<?= $item->id ?>",
                        "name": "<?= $item->name ?>",
                        "price": <?= $product['price'] ?>,
                        "brand": "<?= $item->getBrandName() ?>",
                        "category": "<?= $item->getCatalogName() ?>",
                        "quantity": <?= $product['count'] ?>
                    },
                    <?php endforeach; ?>
                ]
            }
        }
    });
</script>
<?php endif; ?>
