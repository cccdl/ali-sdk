<?php

namespace cccdl\ali\Test;


class TestAccount
{
    public static function getTestAccount(): array
    {
        return [
            'appid' => '请填写您的AppId',

            //支付宝公钥
            'public_key' => '请填写您的支付宝公钥',

            //应用私钥
            'private_key' => '请填写您的应用私钥',

            //回调地址
            'notify_url' => '请填写您的回调地址',

            //获取地址 https://openhome.alipay.com/platform/keyManage.htm?keyType=partner 合作伙伴身份pid
            'pid' => '',
        ];
    }

}