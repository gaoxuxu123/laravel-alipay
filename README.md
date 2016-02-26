

##安装
```
composer require laravel-alipay/alipay dev-master

或者在composer.json中加入

 "require": {

        "laravel-alipay/alipay": "dev-master"
}

```
更新依赖 ``` composer update ```

##使用说明

找到 `config/app.php` 文件
```
'providers' => [

   Lxu\Alipay\AlipayServiceProvider::class,
]
```

运行 `php artisan vendor:publish` 命令

配置文件 `config/lxu-alipay.php` 已经生成，按照要求配置即可

##DEMO

###PC网页支付

```
public function getPay(Request $request)
    {
        //唯一的订单号
        $out_trade_no       = '20160122';
        //订单名称
        $subject            = 'xxxxxxxxxxx';
        //付款金额
        $total_fee          = '0.01';
        //订单描述
        $body               = 'xxxxxxxxxxx';
        $show_url           = '';
        $anti_phishing_key  = '';
        $exter_invoke_ip    = $request->getClientIp();
        $parameter = [
                        "service"           => config('lxu-alipay.pcconfig.service'),
                        "partner"           => trim(config('lxu-alipay.pcconfig.partner')),
                        "payment_type"      => config('lxu-alipay.pcconfig.payment_type'),
                        "notify_url"        => config('lxu-alipay.pcconfig.notify_url'),
                        "return_url"        => config('lxu-alipay.pcconfig.return_url'),
                        "seller_email"      => config('lxu-alipay.pcconfig.seller_email'),
                        "out_trade_no"      => $out_trade_no,
                        "subject"           => $subject,
                        "total_fee"         => $total_fee,
                        "body"              => $body,
                        "show_url"          => $show_url,
                        "anti_phishing_key" => $anti_phishing_key,
                        "exter_invoke_ip"   => $exter_invoke_ip,
                        "_input_charset"    => trim(strtolower(config('alipay.pcconfig.input_charset')))
                    ];
        $pc =  app('PcAlipay');
        $html_text = $pc->buildRequestForm($parameter,"post", "确认");
        echo $html_text;

        }
     /**
         * 支付宝服务器异步通知
         * @param $request
         * @return mixed
         */
        public function getNotifyurl(Request $request)
        {
            $alipayNotify  = app('PcAlipay');
            $verify_result = $alipayNotify->verifyNotify();
            if($verify_result){
                //验证成功
                //获取支付宝的通知返回参数
                $parameter = [
                                "out_trade_no"      => $request->out_trade_no, //商户订单编号；
                                "trade_no"          => $request->trade_no,     //支付宝交易号；
                                "total_fee"         => $request->total_fee,    //交易金额；
                                "trade_status"      => $request->trade_status, //交易状态
                                "notify_id"         => $request->notify_id,    //通知校验ID。
                                "notify_time"       => $request->notify_time,  //通知的发送时间。格式为yyyy-MM-dd HH:mm:ss。
                                "buyer_email"       => $request->buyer_email,  //买家支付宝帐号；
                             ];
                if($request->trade_status == 'TRADE_FINISHED') {
                        //

                }else if ($request->trade_status == 'TRADE_SUCCESS') {

                        //进行订单处理，并传送从支付宝返回的参数；
                        //检查是否已经支付
                        //checkorderstatus($request->out_trade_no);
                        //修改支付状态
                        //orderHandle($parameter);
                }
                //请不要修改或删除
                echo "success";
            }else {
                //验证失败
                echo "fail";
            }
        }
        /**
         * 支付宝页面跳转同步通知
         * @param $request
         * @return mixed
         */
        public function getReturnurl(Request $request)
        {
            $alipayNotify   = app('PcAlipay');
            $verify_result  = $alipayNotify->verifyReturn();
            if($verify_result){

                $parameter = [
                                "out_trade_no"      => $request->out_trade_no, //商户订单编号；
                                "trade_no"          => $request->trade_no,     //支付宝交易号；
                                "total_fee"         => $request->total_fee,    //交易金额；
                                "trade_status"      => $request->trade_status, //交易状态
                                "notify_id"         => $request->notify_id,    //通知校验ID。
                                "notify_time"       => $request->notify_time,  //通知的发送时间。格式为yyyy-MM-dd HH:mm:ss。
                                "buyer_email"       => $request->buyer_email,  //买家支付宝帐号；
                            ];
                if($request->trade_status == 'TRADE_FINISHED' || $request->trade_status == 'TRADE_SUCCESS') {
                    //支付成功
                    //处理订单状态，记录支付记录
                    //检查是否已经支付
                    //checkorderstatus($request->out_trade_no);
                    //修改支付状态
                    //orderHandle($parameter);
                    //跳转支付成功界面
                    return view('');
                }else{

                    //跳转支付失败界面
                    return view('');
                }
            }else{
                 //echo '支付失败!';
                return view('');
            }
        }

```

###手机网页支付

```
首先下载 Openssl工具，windows开发者下载链接: `http://download.csdn.net/detail/gaoxuaiguoyi/9443275`

Linux开发者直接去官网下载openssl.org

解压之后按照:

https://doc.open.alipay.com/doc2/detail.htm?spm=0.0.0.0.y0P2mJ&treeId=58&articleId=103242&docType=1

教程即可生成 `rsa_private_key.pem和rsa_public_key.pem`  2个文件覆盖项目中的key文件夹下载文件即可。

```


##待续

