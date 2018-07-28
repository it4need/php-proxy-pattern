<?php

namespace ProxyPatterns\ProtectionProxy;

use ProxyPatterns\ProtectionProxy\Exceptions;

class HtmlDownloaderProxy implements IHtmlDownloader
{

    private $only_https_requests = false;
    private $downloader;

    public function __construct()
    {
        $this->downloader = new HtmlDownloaderSubject();
    }

    public function download($url)
    {
        if ($this->only_https_requests && !$this->isHttpsUrl($url)) {
            throw new Exceptions\DeniedHttpRequestException();
        }

        return $this->downloader->download($url);
    }

    private function isHttpsUrl($url)
    {
        return parse_url($url)['scheme'] == 'https' ? true : false;
    }

    public function disableHttpRequests()
    {
        $this->only_https_requests = true;
    }

    public function enableHttpRequests()
    {
        $this->only_https_requests = false;
    }
}