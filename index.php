<?php

require_once __DIR__ . '/vendor/autoload.php';

use GaoJie\GaoJieClient\Application;
use GaoJie\GaoJieService\OrderService;

$ioc_con_app = new Application([
    'BaseUri' => 'http://test.goldjet.com.cn/api/index.php?act=bbc&op=bbc_order',
    //    'BaseUri' => 'http://localhost/controller_center/public/export/order/test',
]);
//新增订单服务-----
$orderSrv = new OrderService($ioc_con_app);
//$array    = [
//    'seller'  => '洋葱小姐',
//    'api_key' => 'b00ac9a36735ea614cbe339e6a338195',
//    'order'   => [
//        'order_sn'             => 'WMS201*****61874511',
//        'buyer_name'           => '蔡**',
//        'buyer_phone'          => '183****5195',
//        'buyer_idcard'         => '35**************66',
//        'country_code'         => '\'142\'',
//        'province_code'        => 'code', //固定
//        'buyer_address'        => '广东省^^^广州市^^^白云区^^^广园中路XXX号XXX大厦',
//        'sender_name'          => '测试',
//        'sender_phone'         => '4008******',
//        'sender_country_code'  => '110',
//        'sender_province_code' => 'code',
//        'sender_address'       => '海外',
//        'main_desc'            => 'desc',  //固定
//        'order_name'           => '蔡**',
//        'order_idnum'          => '35**************66',
//        'order_tel'            => '183****5195',
//        'order_account_num'    => '蔡**',
//        'record_no_qg'         => '440196****',
//        'record_name'          => '广州高捷航运物流有限公司',
//        'customs_code'         => '5141',
//        'order_goods'          => [
//            [
//                'customs_goods_id'    => '31978',
//                'goods_num'           => '1',
//                'goods_price'         => '200.00',
//                'trade_curr'          => '142',
//                'order_goods_barcode' => '123',
//            ],
//            [
//                'customs_goods_id'    => '31978',
//                'goods_num'           => '1',
//                'goods_price'         => '200.00',
//                'trade_curr'          => '142',
//                'order_goods_barcode' => '123',
//            ],
//        ],
//    ],
//];
//
//print_r(json_encode($orderSrv->addOrder($array), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)); exit();

//查询订单服务-----
$array = [
    'seller'  => '洋葱小姐',
    'api_key' => 'b00ac9a36735ea614cbe339e6a338195',
    'order'   => [
        'order_sn' => ['201612232058161091', 'A20161223205816188'],
        'vague'    => '2',
    ],
];

print_r(json_encode($orderSrv->checkOrder($array), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)); exit();

//修改订单服务
$array = [
    'seller'  => '洋葱小姐',
    'api_key' => 'b00ac9a36735ea614cbe339e6a338195',
    'order'   => [
        'order_sn'    => '0000078795',
        'order_name'  => '陈xx',
        'order_idnum' => '440981199801102251',
    ],
];

print_r(json_encode($orderSrv->updateOrder($array), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)); exit();
