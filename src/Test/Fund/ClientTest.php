<?php declare(strict_types=1);

namespace cccdl\ali\Test\Fund;

use cccdl\ali\Alipay\Fund\AlipayFundTransUniTransfer;
use cccdl\ali\Test\TestFundAccount;
use PHPUnit\Framework\TestCase;

require '../../../vendor/autoload.php';

class ClientTest extends TestCase
{
    public function testAlipayFundTransUniTransfer(): void
    {
        $c = TestFundAccount::getTestAccount();
        $this->assertIsArray($c);
        $app = new AlipayFundTransUniTransfer($c);
        $result = $app->apply([
            'out_biz_no' => '***********', //商家侧唯一订单号，由商家自定义。对于不同转账请求，商家需保证该订单号在自身系统唯一。
            'trans_amount' => '1', //订单总金额，单位为元，不支持千位分隔符，精确到小数点后两位，取值范围[0.1,100000000]。
            'order_title' => '测试转账', // 转账备注
            'product_code' => 'TRANS_ACCOUNT_NO_PWD', //业务产品码，单笔无密转账到支付宝账户固定为:TRANS_ACCOUNT_NO_PWD；收发现金红包固定为:STD_RED_PACKET；
            'biz_scene' => 'DIRECT_TRANSFER', //业务场景。单笔无密转账固定为 DIRECT_TRANSFER。
            'payee_info' => [
                'identity' => '138888888888', //参与方的标识类型，目前支持如下类型：1、ALIPAY_USER_ID 支付宝的会员ID2、ALIPAY_LOGON_ID：支付宝登录号，支持邮箱和手机号格式
                'identity_type' => 'ALIPAY_LOGON_ID', //参与方的标识类型，目前支持如下类型：1、ALIPAY_USER_ID 支付宝的会员ID2、ALIPAY_LOGON_ID：支付宝登录号，支持邮箱和手机号格式
                'name' => '这里填写手机号名字', //参与方的标识类型，目前支持如下类型：1、ALIPAY_USER_ID 支付宝的会员ID2、ALIPAY_LOGON_ID：支付宝登录号，支持邮箱和手机号格式
            ],
        ]);

        var_dump($result);
        $this->assertIsArray($c);
        $this->assertSame('10000', $result['code']);
        $this->assertSame('Success', $result['msg']);
        $this->assertArrayHasKey('status', $result['status']);
//        $this->assertIsString($result);

    }


}
