<?php

namespace cccdl\ali\Alipay\Pay;

use cccdl\ali\Alipay\BasicAliPay;

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
        $this->options->set('charset', 'UTF-8');
    }

    /**
     * @param array $options
     * @return string
     */
    public function apply(array $options): string
    {
        $this->options->set('biz_content', json_encode($this->params->merge($options), JSON_UNESCAPED_UNICODE));
        $this->options->set('sign', $this->getSign());
        return $this->buildRequestForm();
    }

    /**
     * 建立请求，以表单HTML形式构造（默认）
     */
    protected function buildRequestForm(): string
    {
        $html = "<form id='alipaysubmit' name='alipaysubmit' action='https://openapi.alipay.com/gateway.do?charset=UTF-8' method='POST'>";
        foreach ($this->options->get() as $key => $item) {
            if (!empty($item)) {
                $val = str_replace("'", "&apos;", $item);
                $html .= "<input type='hidden' name='" . $key . "' value='" . $val . "'/>";
            }
        }
        //submit按钮控件请不要含有name属性
        return $html . "<input type='submit' value='ok' style='display:none;'></form>";
    }
}