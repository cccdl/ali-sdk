<?php

namespace cccdl\ali\Alipay\Member;

use cccdl\ali\Alipay\BasicAliPay;
use cccdl\ali\Exceptions\cccdlException;
use cccdl\ali\Exceptions\InvalidResponseException;
use GuzzleHttp\Exception\GuzzleException;

/**
 * 实名证件信息比对验证咨询【非预咨询接口】
 */
class AlipayUserCertdocCertverifyConsult extends BasicAliPay
{
    /**
     * App constructor.
     * @param array $options
     */
    public function __construct(array $options)
    {
        parent::__construct($options);
        $this->options->set('method', 'alipay.user.certdoc.certverify.consult');
        $this->method = str_replace('.', '_', $this->options['method']) . '_response';
    }


    /**
     * @param array $options
     * @return mixed
     * @throws InvalidResponseException
     * @throws GuzzleException
     * @throws cccdlException
     */
    public function apply(array $options)
    {
        $this->options->set('biz_content', json_encode($this->params->merge($options), JSON_UNESCAPED_UNICODE));
        $this->options->set('auth_token', $options['auth_token']);
        $this->options->set('sign', $this->getSign());
        return $this->postBody();
    }
}