<?php

namespace cccdl\ali\Alipay\Pay;

use cccdl\ali\Alipay\BasicAliPay;

/**
 * app支付接口2.0
 * 此处只生成IOS和安卓的调起前端SDK的 orderStr
 * 示例：https://opendocs.alipay.com/open/204/105465/
 */
class AlipayTradeAppPay extends BasicAliPay
{

    /**
     * App constructor.
     * @param array $options
     */
    public function __construct(array $options)
    {
        parent::__construct($options);
        $this->options->set('method', 'alipay.trade.app.pay');
        $this->method = str_replace('.', '_', $this->options['method']) . '_response';
    }

    /**
     * @param array $options
     * @return string
     */
    public function apply(array $options): string
    {
        $this->options->set('biz_content', json_encode($this->params->merge($options), JSON_UNESCAPED_UNICODE));
        $this->options->set('sign', $this->getSign());
        return http_build_query($this->options->get());
    }
}