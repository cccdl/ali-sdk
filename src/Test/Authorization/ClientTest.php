<?php declare(strict_types=1);

namespace cccdl\ali\Test\Authorization;

use cccdl\ali\Alipay\Authorization\Authorization;
use cccdl\ali\Test\TestAccount;
use PHPUnit\Framework\TestCase;

require '../../../vendor/autoload.php';

class ClientTest extends TestCase
{
    public function testAuthorization(): void
    {
        $c = TestAccount::getTestAccount();
        $this->assertIsArray($c);
        $app = new Authorization($c);
        $result = $app->apply([
            'scope' => 'id_verify' //id_verify=支付宝实名信息验证功能场景 kuaijie=支付宝登录场景
        ]);

        echo($result);
        $this->assertIsString($result);

    }


}
