<?php declare(strict_types=1);

namespace cccdl\ali\Test\Member;

use cccdl\ali\Alipay\Member\AlipayUserCertdocCertverifyConsult;
use cccdl\ali\Alipay\Member\AlipayUserCertdocCertverifyPreconsult;
use cccdl\ali\Test\TestAccount;
use PHPUnit\Framework\TestCase;

require '../../../vendor/autoload.php';

class ClientTest extends TestCase
{
    public function testAlipayUserCertdocCertverifyPreconsult(): void
    {
        $c = TestAccount::getTestAccount();
        $this->assertIsArray($c);
        $app = new AlipayUserCertdocCertverifyPreconsult($c);
        $result = $app->apply([

            // 真实姓名
            'user_name' => '',

            // 证件类型。暂仅支持 IDENTITY_CARD （身份证）。
            'cert_type' => 'IDENTITY_CARD',

            // 证件号
            'cert_no' => '',
        ]);

        print_r($result);
        $this->assertIsArray($result);
        $this->assertArrayHasKey('verify_id', $result);
        $this->assertArrayHasKey('code', $result);
        $this->assertArrayHasKey('msg', $result);
    }


    public function testAlipayUserCertdocCertverifyConsult(): void
    {
        $c = TestAccount::getTestAccount();
        $this->assertIsArray($c);
        $app = new AlipayUserCertdocCertverifyConsult($c);
        $result = $app->apply([
            //验证id
            'verify_id' => '',

            //授权后回调的auth_token
            'auth_token' => ''
        ]);

        print_r($result);
        $this->assertIsArray($result);
        $this->assertSame('10000', $result['code']);
        $this->assertSame('Success', $result['msg']);
        $this->assertArrayHasKey('passed', $result);
    }




}
