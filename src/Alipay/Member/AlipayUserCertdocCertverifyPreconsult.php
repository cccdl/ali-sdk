<?php

namespace cccdl\ali\Alipay\Member;

use cccdl\ali\Alipay\BasicAliPay;
use cccdl\ali\Exceptions\cccdlException;
use cccdl\ali\Exceptions\InvalidResponseException;
use GuzzleHttp\Exception\GuzzleException;

/**
 * 实名证件信息比对验证预咨询
 */
class AlipayUserCertdocCertverifyPreconsult extends BasicAliPay
{

    /**
     * App constructor.
     * @param array $options
     */
    public function __construct(array $options)
    {
        parent::__construct($options);
        $this->options->set('method', 'alipay.user.certdoc.certverify.preconsult');
        $this->method = str_replace('.', '_', $this->options['method']) . '_response';
    }


    /**
     * @param array $options
     * @return mixed
     * @throws InvalidResponseException
     * @throws cccdlException
     * @throws GuzzleException
     */
    public function apply(array $options)
    {
        $this->options->set('biz_content', json_encode($this->params->merge($options), JSON_UNESCAPED_UNICODE));
        $this->options->set('sign', $this->getSign());
        return $this->postBody();
    }
}