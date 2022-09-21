<?php

namespace cccdl\ali\Alipay\Pay;

use cccdl\ali\Alipay\BasicAliPay;
use cccdl\ali\Exceptions\cccdlException;
use GuzzleHttp\Exception\GuzzleException;

/**
 * 手机网站支付接口2.0接口
 * 示例：https://opendocs.alipay.com/open/02ivbs?scene=21
 */
class AlipayTradeWapPay extends BasicAliPay
{

    /**
     * App constructor.
     * @param array $options
     */
    public function __construct(array $options)
    {

        parent::__construct($options);
        $this->options->set('method', 'alipay.trade.wap.pay');
    }

    /**
     * @param array $options
     * @return string
     * @throws GuzzleException
     * @throws cccdlException
     */
    public function apply(array $options): string
    {
        $this->options->set('biz_content', json_encode($this->params->merge($options), JSON_UNESCAPED_UNICODE));
        $this->options->set('sign', $this->getSign());
        return $this->getPostBodyContents();
    }
}