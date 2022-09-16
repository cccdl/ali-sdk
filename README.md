# 支付宝 API SDK for PHP  !

### 主要新特性

* 简化使用方法
* 调用简单，统一原样返回
* 对应支付宝api文档分类定义文档夹目录，详细看“命名空间对应”
* 可执行单元测试
* 持续更新中...

### 更新日志

- 1.0.0 增加 《换取授权访问令牌》、《换取授权访问令牌》，请求库改为 guzzlehttp/guzzle 7.3版本
- 1.1.0 增加 《实名证件信息比对验证咨询》
- 1.2.0 增加 《获取移动app端使用的授权参数infoStr》
- 1.2.1 优化 《实名证件信息比对验证咨询【非预咨询接口】》、《实名证件信息比对验证预咨询》 的apply请求方法
- 1.2.2 优化 《获取app授权验证码infoStr》、《换取授权访问令牌》 的apply请求方法
- 2.0.0 增加 《app支付接口2.0》接口，优化所有接口类名按照支付接口名定义
- 2.0.2 增加 获取异步通知参数方法+验签
- 2.0.3 修复 基类调试打印输出导致调用失败
- 2.0.4 修复 alipay.system.oauth.token 接口调用
- 2.1.0 增加 alipay.fund.trans.uni.transfer 单笔转账到支付宝账户接口

## 安装

> 运行环境要求PHP7.1+。

```shell
$ composer require cccdl/ali-sdk
```

### 命名空间对应[支付宝api文档](https://opendocs.alipay.com/apis)

| 命名空间                 | api类型  |
|----------------------|--------|
| Alipay\Authorization | 额外补充   |
| Alipay\Member        | 会员API  |
| Alipay\Pay           | 支付API  |
| Alipay\util          | 工具类API |
| Alipay\Fund          | 资金类API |

### 接口对应文件

| 文件                                                      | 说明                         |
|---------------------------------------------------------|----------------------------|
| Alipay\Member\AlipayUserCertdocCertverifyPreconsult.php | 实名证件信息比对验证预咨询              |
| Alipay\Member\AlipayUserCertdocCertverifyConsult.php    | 实名证件信息比对验证咨询               |
| Alipay\Util\AlipayOpenSystemOauthToken.php              | 换取授权访问令牌                   |
| Alipay\Authorization\Authorization.php                  | 获取移动app端使用的授权参数infoStr     |
| Alipay\Pay\AlipayTradeAppPay.php                        | app支付接口2.0【其实是orderStr的生成】 |
| Alipay\Fund\AlipayFundTransUniTransfer.php              | 单笔转账到支付宝账户                 |

### 快速使用

在您开始之前，您需要注册支付宝并获取您的[凭证](https://opendocs.alipay.com/apis/api_9/alipay.system.oauth.token)。

### 使用

```php
<?php

use cccdl\ali\Alipay\Util\SystemOauthToken;

$config = [
    'appid' => '请填写您的AppId',
    //支付宝公钥
    'public_key' => '请填写您的支付宝公钥',
    //应用私钥
    'private_key' => '请填写您的应用私钥',
    //回调地址
    'notify_url' => '请填写您的回调地址',
     //获取地址 https://openhome.alipay.com/platform/keyManage.htm?keyType=partner 合作伙伴身份pid
    'pid' => '请填写合作伙伴身份pid',
];
$app = new AlipayOpenSystemOauthToken($config);
$result = $app->apply([
    // 授权方式。支持：1.authorization_code，表示换取使用用户授权码code换取授权令牌access_token。 2.refresh_token，表示使用refresh_token刷新获取新授权令牌。
    'grant_type' => 'authorization_code',
    // 授权码，用户对应用授权后得到。本参数在 grant_type 为 authorization_code 时必填；为 refresh_token 时不填。
    'code' => '',
]);
```

### 获取异步通知参数 [点击产看文档](https://opendocs.alipay.com/open/204/105301#%E5%BC%82%E6%AD%A5%E8%BF%94%E5%9B%9E%E7%BB%93%E6%9E%9C%E7%9A%84%E9%AA%8C%E7%AD%BE)

```php
<?php

use cccdl\ali\Alipay\Pay\AlipayTradeAppPay;
$config = [
    'appid' => '请填写您的AppId',
    //支付宝公钥
    'public_key' => '请填写您的支付宝公钥',
    //应用私钥
    'private_key' => '请填写您的应用私钥',
    //回调地址
    'notify_url' => '请填写您的回调地址',
     //获取地址 https://openhome.alipay.com/platform/keyManage.htm?keyType=partner 合作伙伴身份pid
    'pid' => '请填写合作伙伴身份pid',
];
$app = new AlipayTradeAppPay($config);
$app->notify();
```

## 文档

[支付宝api文档](https://opendocs.alipay.com/apis)
[支付宝api开发指南](https://opendocs.alipay.com/open/200)
[支付宝api开放能力](https://opendocs.alipay.com/apis/01da3s)

## 问题

[提交 Issue](https://github.com/cccdl/ali-sdk/issues)，不符合指南的问题可能会立即关闭。

## Contributing

You can contribute in one of three ways:

1. File bug reports using the [issue tracker](https://github.com/cccdl/ali-sdk/issues).
2. Answer questions or fix bugs on the [issue tracker](https://github.com/cccdl/ali-sdk/issues).
3. Contribute new features or update the wiki.

_The code contribution process is not very formal. You just need to make sure that you follow the PSR-0, PSR-1, and
PSR-2 coding guidelines. Any new code contributions must be accompanied by unit tests where applicable._

## License

MIT
