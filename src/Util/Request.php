<?php


namespace cccdl\ali\Util;


use cccdl\ali\Exceptions\cccdlException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

/**
 * 请求服务类
 * Trait Request
 * @package cccdl\ali\Util
 */
trait Request
{
    /**
     * post请求-获取body
     * @return mixed
     * @throws GuzzleException
     * @throws cccdlException
     */
    protected function getPostBody()
    {
        $client = new Client([
            'timeout' => 10,
        ]);

        $response = $client->post($this->gateway, ['form_params' => $this->options->get()]);

        if ($response->getStatusCode() != 200) {
            throw new cccdlException('请求失败: ' . $response->getStatusCode());
        }

        return json_decode($response->getBody(), true);

    }


}
