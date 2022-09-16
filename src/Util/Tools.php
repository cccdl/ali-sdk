<?php


namespace cccdl\ali\Util;


trait Tools
{
    /**
     * 去除证书前后内容及空白
     * @param string $sign
     * @return string
     */
    protected function trimCert(string $sign): string
    {
        // if (file_exists($sign)) $sign = file_get_contents($sign);
        return preg_replace(['/\s+/', '/\-{5}.*?\-{5}/'], '', $sign);
    }

}