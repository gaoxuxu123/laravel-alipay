<?php
/**
 * Created by PhpStorm.
 * User: xu.gao
 * Date: 2016/2/23
 * Time: 14:22
 */

  return [

      //pc配置
      'pcconfig'=>
          [
              'partner'             =>'xxxxxxxxxxxxxxxxxx',   //这里是你在成功申请支付宝接口后获取到的PID；
              'key'                 =>'xxxxxxxxxxxxxxxxxx',   //这里是你在成功申请支付宝接口后获取到的Key
              'seller_id'           =>'xxxxxxxxxxxxxxxxxx',   //就是partner
              'sign_type'           =>strtoupper('MD5'),      //不需修改
              'input_charset'       =>strtolower('utf-8'),    //不需修改
              'transport'           =>'http',
              'notify_url'          =>'http://自己的域名/自己的路由/方法',//异步通知
              'return_url'          =>'http://自己的域名/自己的路由/方法',//同步通知
              'refund_notify_url'   => 'http://自己的域名/自己的路由/方法',//不做退款无需配置
              'service'             =>'create_direct_pay_by_user',    //不需修改,支付service
              'refundservice'       =>'refund_fastpay_by_platform_pwd',//退款service
              'payment_type'        =>'1',                            //不需修改
              //卖家账户信息
              'seller_email'        =>'xxxxxxxxxxxx@xxx.com',          //卖家邮箱

          ],
      //手机配置
      'mobileconfig'=>
          [
              'partner'             =>'xxxxxxxxxxxxxxxxxxxxxx',
              'seller_id'           =>'xxxxxxxxxxxxxxxxxxxxxx',
              'key'                 =>'xxxxxxxxxxxxxxxxxxxxxx',
              'sign_type'           =>strtoupper('RSA'),                      //不需修改
              'input_charset'       =>strtolower('utf-8'),                    //不需修改
              'notify_url'          =>'http://自己的域名/自己的路由/方法',        //异步通知
              'return_url'          =>'http://自己的域名/自己的路由/方法',        //同步通知
              'refund_notify_url'   => 'http://自己的域名/自己的路由/方法',//不做退款无需配置
              'transport'           =>'http',
              'service'             =>'alipay.wap.create.direct.pay.by.user',//不需修改
              'refundservice'       =>'refund_fastpay_by_platform_pwd',//退款service
              'payment_type'        =>'1',
              'seller_email'        =>'xxxxxxxxxxxx@xxx.com',
          ]

  ];