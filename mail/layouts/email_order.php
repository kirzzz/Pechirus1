<?php

use app\models\Orders;
use yii\helpers\Url;
use yii\mail\MessageInterface;
use yii\web\View;

/* @var $this View view component instance */
/* @var $message MessageInterface the message being composed */
/* @var $order Orders */
?>
<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <title>
    </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
        #outlook a{padding: 0;}
        .ReadMsgBody{width: 100%;}
        .ExternalClass{width: 100%;}
        .ExternalClass *{line-height: 100%;}
        body{margin: 0; padding: 0; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;}
        table, td{border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;}
        img{border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic;}
        p{display: block; margin: 13px 0;}
    </style>
    <!--[if !mso]><!-->
    <style type="text/css">
        @media only screen and (max-width:480px) {
            @-ms-viewport {width: 320px;}
            @viewport {	width: 320px; }
        }
    </style>
    <!--<![endif]-->
    <!--[if mso]>
    <xml>
        <o:OfficeDocumentSettings>
            <o:AllowPNG/>
            <o:PixelsPerInch>96</o:PixelsPerInch>
        </o:OfficeDocumentSettings>
    </xml>
    <![endif]-->
    <!--[if lte mso 11]>
    <style type="text/css">
        .outlook-group-fix{width:100% !important;}
    </style>
    <![endif]-->
    <style type="text/css">
        @media only screen and (min-width:480px) {
            .dys-column-per-100 {
                width: 100.000000% !important;
                max-width: 100.000000%;
            }
        }
        @media only screen and (min-width:480px) {
            .dys-column-per-100 {
                width: 100.000000% !important;
                max-width: 100.000000%;
            }
        }
        @media only screen and (min-width:480px) {
            .dys-column-per-5 {
                width: 5% !important;
                max-width: 5%;
            }
            .dys-column-per-45 {
                width: 45% !important;
                max-width: 45%;
            }
        }
        @media only screen and (max-width:480px) {

            table.full-width-mobile { width: 100% !important; }
            td.full-width-mobile { width: auto !important; }

        }
        @media only screen and (min-width:480px) {
            .dys-column-per-100 {
                width: 100.000000% !important;
                max-width: 100.000000%;
            }
        }
        @media only screen and (min-width:480px) {
            .dys-column-per-100 {
                width: 100.000000% !important;
                max-width: 100.000000%;
            }
        }
    </style>
</head>
<body>
<div>
    <table align='center' background='https://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg' border='0' cellpadding='0' cellspacing='0' role='presentation' style='background:url(https://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg) top center / auto repeat;width:100%;'>
        <tbody>
        <tr>
            <td>
                <!--[if mso | IE]>
                <v:rect style="mso-width-percent:1000;" xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false"><v:fill src="https://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg" origin="0.5, 0" position="0.5, 0" type="tile" /><v:textbox style="mso-fit-shape-to-text:true" inset="0,0,0,0">
                <![endif]-->
                <div style='margin:0px auto;max-width:600px;'>
                    <div style='font-size:0;line-height:0;'>
                        <table align='center' border='0' cellpadding='0' cellspacing='0' role='presentation' style='width:100%;'>
                            <tbody>
                            <tr>
                                <td style='direction:ltr;font-size:0px;padding:20px 0px 30px 0px;text-align:center;vertical-align:top;'>
                                    <!--[if mso | IE]>
                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td style="vertical-align:top;width:600px;">
                                    <![endif]-->
                                    <div class='dys-column-per-100 outlook-group-fix' style='direction:ltr;display:inline-block;font-size:13px;text-align:left;vertical-align:top;width:100%;'>
                                        <table border='0' cellpadding='0' cellspacing='0' role='presentation' width='100%'>
                                            <tbody>
                                            <tr>
                                                <td style='padding:0px 20px;vertical-align:top;'>
                                                    <table border='0' cellpadding='0' cellspacing='0' role='presentation' style='' width='100%'>
                                                        <tr>
                                                            <td align='left' style='font-size:0px;padding:0px;word-break:break-word;'>
                                                                <table border='0' cellpadding='0' cellspacing='0' style='cellpadding:0;cellspacing:0;color:#000000;font-family:Helvetica, Arial, sans-serif;font-size:13px;line-height:22px;table-layout:auto;width:100%;' width='100%'>
                                                                    <tr>
                                                                        <td align='left'>
                                                                            <a href='#'>
                                                                                <img align='left' alt='Pechirus' height='33' padding='5px' src='https://i.ibb.co/r4FRb1c/logo-dark.png' width='120' />
                                                                            </a>
                                                                        </td>
                                                                        <td align='right' style='vertical-align:bottom;' width='34px'>
                                                                            <a href='https://www.instagram.com/pechirus/'>
                                                                                <img alt='Instagram' height='22' src='https://swu-cs-assets.s3.amazonaws.com/OSET/social/instagrey.png' width='22' />
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!--[if mso | IE]>
                                    </td></tr></table>
                                    <![endif]-->
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--[if mso | IE]>
                </v:textbox></v:rect>
                <![endif]-->
            </td>
        </tr>
        </tbody>
    </table>
    <table align='center' border='0' cellpadding='0' cellspacing='0' role='presentation' style='background:#f7f7f7;background-color:#f7f7f7;width:100%;'>
        <tbody>
        <tr>
            <td>
                <div style='margin:0px auto;max-width:600px;'>
                    <table align='center' border='0' cellpadding='0' cellspacing='0' role='presentation' style='width:100%;'>
                        <tbody>
                        <tr>
                            <td style='direction:ltr;font-size:0px;padding:20px 0;text-align:center;vertical-align:top;'>
                                <!--[if mso | IE]>
                                <table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td style="vertical-align:top;width:600px;">
                                <![endif]-->
                                <div class='dys-column-per-100 outlook-group-fix' style='direction:ltr;display:inline-block;font-size:13px;text-align:left;vertical-align:top;width:100%;'>
                                    <table border='0' cellpadding='0' cellspacing='0' role='presentation' style='vertical-align:top;' width='100%'>
                                        <tr>
                                            <td align='center' style='font-size:0px;padding:10px 25px;word-break:break-word;'>
                                                <div style='color:#4d4d4d;font-family:Oxygen, Helvetica neue, sans-serif;font-size:32px;font-weight:700;line-height:37px;text-align:center;'>
                                                    Спасибо за заказ!
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align='center' style='font-size:0px;padding:10px 25px;word-break:break-word;'>
                                                <div style='color:#777777;font-family:Oxygen, Helvetica neue, sans-serif;font-size:14px;line-height:21px;text-align:center;'>
                                                    Благодарим вас за заказ на сайте Pechirus! Вы можете сделать нам приятно и оставить положительный отзыв на
                                                    <a href='https://market.yandex.ru/shop--pechirus/295931/reviews'>
                                                        Яндекс Маркете.
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <!--[if mso | IE]>
                                </td></tr></table>
                                <![endif]-->
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
    <table align='center' border='0' cellpadding='0' cellspacing='0' role='presentation' style='background:#f7f7f7;background-color:#f7f7f7;width:100%;'>
        <tbody>
        <tr>
            <td>
                <div style='margin:0px auto;max-width:600px;'>
                    <table align='center' border='0' cellpadding='0' cellspacing='0' role='presentation' style='width:100%;'>
                        <tbody>
                        <tr>
                            <td style='direction:ltr;font-size:0px;padding:20px 0;text-align:center;vertical-align:top;'>
                                <!--[if mso | IE]>
                                <table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td style="vertical-align:top;width:270px;">
                                <![endif]-->
                                <div class='dys-column-per-45 outlook-group-fix' style='direction:ltr;display:inline-block;font-size:13px;text-align:left;vertical-align:top;width:100%;'>
                                    <table border='0' cellpadding='0' cellspacing='0' role='presentation' width='100%'>
                                        <tbody>
                                        <tr>
                                            <td style='background-color:#ffffff;border:1px solid #e5e5e5;padding:15px;vertical-align:top;'>
                                                <table border='0' cellpadding='0' cellspacing='0' role='presentation' style='' width='100%'>
                                                    <tr>
                                                        <td align='left' style='font-size:0px;padding:0px ;word-break:break-word;'>
                                                            <div style='color:#4d4d4d;font-family:Oxygen, Helvetica neue, sans-serif;font-size:18px;font-weight:700;line-height:25px;text-align:left;'>
                                                                Адрес:
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align='left' style='font-size:0px;padding:0px;word-break:break-word;'>
                                                            <div style='color:#777777;font-family:Oxygen, Helvetica neue, sans-serif;font-size:14px;line-height:23px;text-align:left;'>
                                                                <?= $order->address?$order->address:'Самовывоз - МКАД 92км, Мытищи ул. Красный поселок, д.2a, ТЦ Садовод Линия Е, павильоны №47-48' ?>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!--[if mso | IE]>
                                </td>
                                <![endif]-->
                                <!-- empty column to create gap -->
                                <!--[if mso | IE]>
                                <td style="vertical-align:top;width:30px;">
                                <![endif]-->
                                <div class='dys-column-per-5 outlook-group-fix' style='direction:ltr;display:inline-block;font-size:13px;text-align:left;vertical-align:top;width:100%;'>
                                    <table border='0' cellpadding='0' cellspacing='0' role='presentation' width='100%'>
                                        <tbody>
                                        <tr>
                                            <td style='background-color:#FFFFFF;padding:0;vertical-align:top;'>
                                                <table border='0' cellpadding='0' cellspacing='0' role='presentation' style='' width='100%'>
                                                </table>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!--[if mso | IE]>
                                </td><td style="vertical-align:top;width:270px;">
                                <![endif]-->
                                <div class='dys-column-per-45 outlook-group-fix' style='direction:ltr;display:inline-block;font-size:13px;text-align:left;vertical-align:top;width:100%;'>
                                    <table border='0' cellpadding='0' cellspacing='0' role='presentation' width='100%'>
                                        <tbody>
                                        <tr>
                                            <td style='background-color:#ffffff;border:1px solid #e5e5e5;padding:15px;vertical-align:top;'>
                                                <table border='0' cellpadding='0' cellspacing='0' role='presentation' style='' width='100%'>
                                                    <tr>
                                                        <td align='left' style='font-size:0px;padding:0px ;word-break:break-word;'>
                                                            <div style='color:#4d4d4d;font-family:Oxygen, Helvetica neue, sans-serif;font-size:18px;font-weight:700;line-height:25px;text-align:left;'>
                                                                Дата создания заказа:
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align='left' style='font-size:0px;padding:0px;word-break:break-word;'>
                                                            <div style='color:#777777;font-family:Oxygen, Helvetica neue, sans-serif;font-size:14px;line-height:22px;text-align:left;'>
                                                                <?= date('d.m.Y H:i:s',$order->created_at) ?>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align='left' style='font-size:0px;padding:0px ;word-break:break-word;'>
                                                            <div style='color:#4d4d4d;font-family:Oxygen, Helvetica neue, sans-serif;font-size:18px;font-weight:700;line-height:25px;text-align:left;'>
                                                                № Заказа
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align='left' style='font-size:0px;padding:0px;word-break:break-word;'>
                                                            <div style='color:#777777;font-family:Oxygen, Helvetica neue, sans-serif;font-size:14px;line-height:22px;text-align:left;'>
                                                                <?= $order->article ?>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!--[if mso | IE]>
                                </td></tr></table>
                                <![endif]-->
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
    <!--[if mso | IE]>
    <table align="center" border="0" cellpadding="0" cellspacing="0" style="width:600px;" width="600"><tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">
    <![endif]-->
    <div style='background:#FFFFFF;background-color:#FFFFFF;margin:0px auto;max-width:600px;'>
        <table align='center' border='0' cellpadding='0' cellspacing='0' role='presentation' style='background:#FFFFFF;background-color:#FFFFFF;width:100%;'>
            <tbody>
            <tr>
                <td style='direction:ltr;font-size:0px;padding:20px 0;text-align:center;vertical-align:top;'>
                    <!--[if mso | IE]>
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td style="vertical-align:top;width:600px;">
                    <![endif]-->
                    <div class='dys-column-per-100 outlook-group-fix' style='direction:ltr;display:inline-block;font-size:13px;text-align:left;vertical-align:top;width:100%;'>
                        <table border='0' cellpadding='0' cellspacing='0' role='presentation' style='vertical-align:top;' width='100%'>
                            <tr>
                                <td align='left' style='font-size:0px;padding:10px 25px;word-break:break-word;'>
                                    <table border='0' cellpadding='0' cellspacing='0' style="cellpadding:0;cellspacing:0;color:#777777;font-family:'Oxygen', 'Helvetica Neue', helvetica, sans-serif;font-size:14px;line-height:21px;table-layout:auto;width:100%;" width='100%'>
                                        <tr>
                                            <th style='text-align: left; border-bottom: 1px solid #cccccc; color: #4d4d4d; font-weight: 700; padding-bottom: 5px;' width='50%'>
                                                Продукт
                                            </th>
                                            <th style='text-align: right; border-bottom: 1px solid #cccccc; color: #4d4d4d; font-weight: 700; padding-bottom: 5px;' width='15%'>
                                                Количество
                                            </th>
                                            <th style='text-align: right; border-bottom: 1px solid #cccccc; color: #4d4d4d; font-weight: 700; padding-bottom: 5px; ' width='15%'>
                                                Сумма
                                            </th>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td align='left' style='font-size:0px;padding:10px 25px;word-break:break-word;'>
                                    <table border='0' cellpadding='0' cellspacing='0' style='cellpadding:0;cellspacing:0;color:#000000;font-family:Helvetica, Arial, sans-serif;font-size:13px;line-height:22px;table-layout:auto;width:100%;' width='100%'>
                                            <?php $products = json_decode($order->productInfo,true);
                                                foreach ($products as $product):
                                                    $product_info = \app\models\Product::find()->andWhere(['id'=>$product['idProduct']])->one()?>
                                                    <tr style="font-size:14px; line-height:19px; font-family: 'Oxygen', 'Helvetica Neue', helvetica, sans-serif; color:#777777">
                                                        <td style="text-align:left; font-size:14px; line-height:19px; font-family: ' oxygen', 'helvetica neue', helvetica, sans-serif; color: #777777;">
                                                            <a href="<?= Url::toRoute(['site/product','id'=> $product_info->id],true) ?>" target="_blank">
                                                                <span style="color: #4d4d4d; font-weight:bold;"><?= $product_info->name ?></span>
                                                            </a>
                                                        </td>
                                                        <td style="text-align:center; " width="10%">
                                                            <?= $product['count'] ?>
                                                        </td>
                                                        <td style="text-align:right; " width="10%">
                                                            &#8381;<?= round($product['count']* $product['price']) ?>
                                                        </td>
                                                    </tr>
                                            <?php endforeach; ?>
                                        <tr style="font-size:14px; line-height:19px; font-family: 'Oxygen', 'Helvetica Neue', helvetica, sans-serif; color:#777777">
                                            <td width='50%'>
                                            </td>
                                            <td style='text-align:right; padding-right: 10px; border-top: 1px solid #cccccc;'>
                                            <span style='padding-bottom:8px; display: inline-block;'>
                                                Доставка
                                            </span>
                                                <br/>
                                            <span style='display: inline-block;font-weight: bold; color: #4d4d4d'>
                                                Общая сумма заказа
                                            </span>
                                            </td>
                                            <td style='text-align: right; border-top: 1px solid #cccccc;'>
                                            <span style='padding-bottom:8px; display: inline-block;'>
                                                <?= array_search($order->regionOfDelivery,array_column(Orders::REGION_OF_DELIVERY,'id'))!==false?Orders::REGION_OF_DELIVERY[array_search($order->regionOfDelivery,array_column(Orders::REGION_OF_DELIVERY,'id'))]['data-order-region-price']:0 ?>
                                            </span>
                                                <br/>
                                            <span style='display: inline-block;font-weight: bold; color: #4d4d4d'>
                                                <?= $order->price ?>
                                            </span>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <!--[if mso | IE]>
                    </td></tr></table>
                    <![endif]-->
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <!--[if mso | IE]>
    </td></tr></table>
    <![endif]-->
    <table align='center' border='0' cellpadding='0' cellspacing='0' role='presentation' style='background:#f7f7f7;background-color:#f7f7f7;width:100%;'>
        <tbody>
        <tr>
            <td>
                <div style='margin:0px auto;max-width:600px;'>
                    <table align='center' border='0' cellpadding='0' cellspacing='0' role='presentation' style='width:100%;'>
                        <tbody>
                        <tr>
                            <td style='direction:ltr;font-size:0px;padding:20px 0;text-align:center;vertical-align:top;'>
                                <!--[if mso | IE]>
                                <table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td style="vertical-align:top;width:600px;">
                                <![endif]-->
                                <div class='dys-column-per-100 outlook-group-fix' style='direction:ltr;display:inline-block;font-size:13px;text-align:left;vertical-align:top;width:100%;'>
                                    <table border='0' cellpadding='0' cellspacing='0' role='presentation' style='vertical-align:top;' width='100%'>
                                        <tr>
                                            <td align='center' style='font-size:0px;padding:5px 25px;word-break:break-word;'>
                                                <div style='color:#777777;font-family:Oxygen, Helvetica neue, sans-serif;font-size:14px;font-style:bold;font-weight:700;line-height:21px;text-align:center;'>
                                                    Pechirus
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align='center' style='font-size:0px;padding:5px 25px;word-break:break-word;'>
                                                <div style='color:#777777;font-family:Oxygen, Helvetica neue, sans-serif;font-size:14px;font-style:bold;line-height:1;text-align:center;'>
                                                    Адрес: МКАД 92км, Мытищи ул. Красный поселок, д.2a, ТЦ Садовод Линия Е, павильоны №47-48
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align='center' style='font-size:0px;padding:5px 25px;word-break:break-word;'>
                                                <div style='color:#777777;font-family:Oxygen, Helvetica neue, sans-serif;font-size:14px;font-style:bold;line-height:1;text-align:center;'>
                                                    pechirus@gmail.com, info@pechirus.ru
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <!--[if mso | IE]>
                                </td></tr></table>
                                <![endif]-->
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>
</body>
</html>
