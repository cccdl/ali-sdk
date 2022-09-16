<?php

namespace cccdl\ali\Alipay\Authorization;

use cccdl\ali\Alipay\BasicAliPay;

/**
 * 获取app授权验证码infoStr
 * 授权服务类
 */
class Authorization extends BasicAliPay
{
    /**
     * App constructor.
     * @param array $options
     */
    public function __construct(array $options)
    {
        parent::__construct($options);
        $this->options->set('pid', $options['pid']);
    }

    /**
     * id_verify=预咨询 kuaijie=支付宝登录场景
     * @param array $options
     * @return string
     */
    public function apply(array $options = []): string
    {
        //支付宝实名信息验证 示例
        //apiname=com.alipay.account.auth&app_id=xxxxx&app_name=mc&auth_type=AUTHACCOUNT&biz_type=openservice&method=alipay.open.auth.sdk.code.get&pid=xxxxx&product_id=APP_FAST_LOGIN&scope=kuaijie&sign_type=RSA2&target_id=20141225xxxx&sign=fMcp4GtiM6rxSIeFnJCVePJKV43eXrUP86CQgiLhDHH2u%2FdN75eEvmywc2ulkm7qKRetkU9fbVZtJIqFdMJcJ9Yp%2BJI%2FF%2FpESafFR6rB2fRjiQQLGXvxmDGVMjPSxHxVtIqpZy5FDoKUSjQ2%2FILDKpu3%2F%2BtAtm2jRw1rUoMhgt0%3D

        //支付宝登录场景示例
        //apiname=com.alipay.account.auth&app_id=xxxxx&app_name=mc&auth_type=AUTHACCOUNT&biz_type=openservice&method=alipay.open.auth.sdk.code.get&pid=xxxxx&product_id=APP_FAST_LOGIN&scope=kuaijie&sign_type=RSA2&target_id=20141225xxxx&sign=fMcp4GtiM6rxSIeFnJCVePJKV43eXrUP86CQgiLhDHH2u%2FdN75eEvmywc2ulkm7qKRetkU9fbVZtJIqFdMJcJ9Yp%2BJI%2FF%2FpESafFR6rB2fRjiQQLGXvxmDGVMjPSxHxVtIqpZy5FDoKUSjQ2%2FILDKpu3%2F%2BtAtm2jRw1rUoMhgt0%3D

        $arr = array_merge([
            'apiname' => 'com.alipay.account.auth',
            'app_id' => $this->options->get('app_id'),
            'app_name' => 'mc',
            'auth_type' => 'AUTHACCOUNT',
            'biz_type' => 'openservice',
            'method' => 'alipay.open.auth.sdk.code.get',
            'pid' => $this->options->get('pid'),
            'product_id' => 'APP_FAST_LOGIN',
            'scope' => 'id_verify', //id_verify=支付宝实名信息验证功能场景 kuaijie=支付宝登录场景
            'sign_type' => 'RSA2',
            'target_id' => md5(mt_rand(999, 99999) . time()), //商户标识该次用户授权请求的ID，该值在商户端应保持唯一
        ], $options);

        $infoStr = http_build_query($arr);
        $sign = $this->getSign($infoStr);
        $infoStr .= '&sign=' . $sign;
        return $infoStr;

    }

}