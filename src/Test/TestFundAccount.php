<?php

namespace cccdl\ali\Test;


class TestFundAccount
{
    public static function getTestAccount(): array
    {
        return [
            //支付宝appid
            'appid' => '',

            //支付宝公钥
            'public_key' => '',

            //应用私钥
            'private_key' => '',

            //app应用证书
            'app_cert' => '',

            //支付宝根证书
            'root_cert' => ''
        ];
    }

}