

##安装
```
composer require laravel-alipay/alipay

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
/**
 $request 控制器传递的Request 参数
*/
public function pay($request)
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

```

##待续

