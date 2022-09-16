<?php declare(strict_types=1);

namespace cccdl\ali\Test\Util;

use cccdl\ali\Alipay\Util\AlipayOpenSystemOauthToken;
use cccdl\ali\Exceptions\cccdlException;
use cccdl\ali\Exceptions\InvalidResponseException;
use cccdl\ali\Test\TestAccount;
use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;

require '../../../vendor/autoload.php';

class ClientTest extends TestCase
{
    /**
     * @throws GuzzleException
     * @throws cccdlException
     * @throws InvalidResponseException
     */
    public function testSystemOauthToken(): void
    {
        $c = TestAccount::getTestAccount();
        $this->assertIsArray($c);
        $app = new AlipayOpenSystemOauthToken($c);
        $result = $app->apply([
            // 授权方式。支持：1.authorization_code，表示换取使用用户授权码code换取授权令牌access_token。 2.refresh_token，表示使用refresh_token刷新获取新授权令牌。
            'grant_type' => 'authorization_code',
            // 授权码，用户对应用授权后得到。本参数在 grant_type 为 authorization_code 时必填；为 refresh_token 时不填。
            'code' => '90553ba41fff74cfc33df9708dcde74d',
        ]);

        print_r($result);
        $this->assertIsArray($result);
        $this->assertArrayHasKey('access_token', $result);
        $this->assertArrayHasKey('alipay_user_id', $result);
        $this->assertArrayHasKey('expires_in', $result);
        $this->assertArrayHasKey('re_expires_in', $result);
        $this->assertArrayHasKey('refresh_token', $result);
        $this->assertArrayHasKey('user_id', $result);
//        $this->assertArrayHasKey('msg', $result);


    }

}
