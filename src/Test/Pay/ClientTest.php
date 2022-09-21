<?php declare(strict_types=1);

namespace cccdl\ali\Test\Pay;

use cccdl\ali\Alipay\Pay\AlipayTradeAppPay;
use cccdl\ali\Alipay\Pay\AlipayTradeWapPay;
use cccdl\ali\Test\TestAccount;
use PHPUnit\Framework\TestCase;

require '../../../vendor/autoload.php';

class ClientTest extends TestCase
{

    /**
     * 测试app支付创建订单接口
     * @return void
     */
    public function testAlipayTradeAppPay(): void
    {
        $c = TestAccount::getTestAccount();
        $this->assertIsArray($c);
        $app = new AlipayTradeAppPay($c);
        $result = $app->apply([
            'total_amount' => 1,        // 订单总金额。单位为元，精确到小数点后两位，取值范围：[0.01,100000000]
            'subject' => '输入订单标题', // 订单标题。注意：不可使用特殊字符，如 /，=，& 等
            'out_trade_no' => '输入订单号'   // 商户订单号。由商家自定义，64个字符以内，仅支持字母、数字、下划线且需保证在商户端不重复
        ]);

        print_r($result);
        $this->assertIsString($result);
    }


    /**
     * 手机网站支付接口2.0接口
     * @return void
     */
    public function testAlipayTradeWapPay(): void
    {
        date_default_timezone_set('PRC');
        $c = TestAccount::getTestAccount();
        $this->assertIsArray($c);
        $app = new AlipayTradeWapPay($c);
        $result = $app->apply([
            'total_amount' => 0.01,        // 订单总金额。单位为元，精确到小数点后两位，取值范围：[0.01,100000000]
            'subject' => '测试', // 订单标题。注意：不可使用特殊字符，如 /，=，& 等
            'body' => '购买测试商品0.01元', // 订单标题。注意：不可使用特殊字符，如 /，=，& 等
            'out_trade_no' => '202292118473372',   // 商户订单号。由商家自定义，64个字符以内，仅支持字母、数字、下划线且需保证在商户端不重复
            'product_code' => 'QUICK_WAP_WAY',   // 商户订单号。由商家自定义，64个字符以内，仅支持字母、数字、下划线且需保证在商户端不重复
            'timeout_express' => '1m'   // 商户订单号。由商家自定义，64个字符以内，仅支持字母、数字、下划线且需保证在商户端不重复
        ]);

        print_r($result);
        $this->assertIsString($result);
    }

}
