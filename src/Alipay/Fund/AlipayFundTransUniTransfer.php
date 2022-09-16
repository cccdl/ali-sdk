<?php

namespace cccdl\ali\Alipay\Fund;

use cccdl\ali\Alipay\BasicAliPay;
use cccdl\ali\Exceptions\cccdlException;
use cccdl\ali\Exceptions\InvalidArgumentException;
use cccdl\ali\Exceptions\InvalidResponseException;
use GuzzleHttp\Exception\GuzzleException;

/**
 * 单笔转账接口
 */
class AlipayFundTransUniTransfer extends BasicAliPay
{
    /**
     * App constructor.
     * @param array $options
     */
    public function __construct(array $options)
    {
        parent::__construct($options);
        $this->options->set('method', 'alipay.fund.trans.uni.transfer');
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
        $this->setAppCertSnAndRootCertSn();
        $this->options->set('biz_content', json_encode($this->params->merge($options), JSON_UNESCAPED_UNICODE));
        $this->options->set('sign', $this->getSign());
        return $this->postBody();
    }

    /**
     * 新版 设置网关应用公钥证书SN、支付宝根证书SN
     */
    public function setAppCertSnAndRootCertSn()
    {
        if (!$this->config->get('app_cert')) {

            throw new InvalidArgumentException("Missing Config -- [app_cert]");
        }
        if (!$this->config->get('root_cert')) {
            throw new InvalidArgumentException("Missing Config -- [root_cert]");
        }
        $this->options->set('app_cert_sn', $this->getCertSN($this->config->get('app_cert')));
        $this->options->set('alipay_root_cert_sn', $this->getRootCertSN($this->config->get('root_cert')));
        if (!$this->options->get('app_cert_sn')) {
            throw new InvalidArgumentException("Missing options -- [app_cert_sn]");
        }
        if (!$this->options->get('alipay_root_cert_sn')) {
            throw new InvalidArgumentException("Missing options -- [alipay_root_cert_sn]");
        }
    }
    
}