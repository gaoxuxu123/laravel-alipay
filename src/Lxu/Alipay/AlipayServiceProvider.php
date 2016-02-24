<?php
/**
 * Created by PhpStorm.
 * User: xu.gao
 * Date: 2016/2/23
 * Time: 14:16
 */

namespace Lxu\Alipay;

use Illuminate\Support\ServiceProvider;
use Lxu\Alipay\pc\PcSdk;
use Lxu\Alipay\mobile\MobileSdk;

class AlipayServiceProvider extends ServiceProvider{


    public function boot()
    {

        $this->publishes([

            __DIR__.'/config/lxu-alipay.php' => config_path('lxu-alipay.php'),
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/lxu-alipay.php', 'lxu-alipay');
        //PC支付对象绑定
        $this->app->bind('PcAlipay', function () {

            $pcAlipay = new PcSdk();
            $pcAlipay->partner       = config('lxu-alipay.pcconfig.partner');
            $pcAlipay->cacert        = __DIR__.'\\config\\cacert.pem';
            $pcAlipay->key           = config('lxu-alipay.pcconfig.key');
            $pcAlipay->sign_type     = config('lxu-alipay.pcconfig.sign_type');
            $pcAlipay->input_charset = config('lxu-alipay.pcconfig.input_charset');
            $pcAlipay->transport     = config('lxu-alipay.pcconfig.transport');
            return $pcAlipay;
        });
        //手机支付对象绑定
        $this->app->bind('MobileAlipay', function () {

            $mobileAlipay = new MobileSdk();
            $mobileAlipay->partner              = config('lxu-alipay.mobileconfig.partner');
            $mobileAlipay->cacert               = __DIR__.'\\config\\cacert.pem';
            $mobileAlipay->key                  = config('lxu-alipay.mobileconfig.key');
            $mobileAlipay->sign_type            = config('lxu-alipay.mobileconfig.sign_type');
            $mobileAlipay->input_charset        = config('lxu-alipay.mobileconfig.input_charset');
            $mobileAlipay->ali_public_key_path  = __DIR__.'\\config\\key\\alipay_public_key.pem';
            $mobileAlipay->private_key_path     = __DIR__.'\\config\\key\\rsa_private_key.pem';
            $mobileAlipay->transport            = config('lxu-alipay.mobileconfig.transport');
            return $mobileAlipay;
        });
    }
}