<?php

class ProtectionProxyTest extends \PHPUnit\Framework\TestCase
{

    /** @test */
    public function html_downloader_can_download_every_website()
    {
        $website_downloader = new \ProxyPatterns\ProtectionProxy\HtmlDownloaderSubject();
        $https_html = $website_downloader->download('http://en.wikipedia.org/wiki/Proxy_pattern');
        $http_html = $website_downloader->download('https://en.wikipedia.org/wiki/Proxy_pattern');

        $this->assertInternalType('string', $https_html);
        $this->assertInternalType('string', $http_html);

        $this->assertEquals($http_html, $https_html);

    }

    /** @test */
    public function html_downloader_proxy_can_download_every_website_by_default()
    {
        $website_downloader = new \ProxyPatterns\ProtectionProxy\HtmlDownloaderProxy();
        $http_html = $website_downloader->download('http://en.wikipedia.org/wiki/Proxy_pattern');
        $https_html = $website_downloader->download('https://en.wikipedia.org/wiki/Proxy_pattern');

        $this->assertInternalType('string', $http_html);
        $this->assertInternalType('string', $https_html);

        $this->assertEquals($http_html, $https_html);
    }

    /** @test */
    public function html_downloader_proxy_cannot_download_http_website_after_configuration()
    {
        $this->expectException(\ProxyPatterns\ProtectionProxy\Exceptions\DeniedHttpRequestException::class);

        $website_downloader = new \ProxyPatterns\ProtectionProxy\HtmlDownloaderProxy();
        $website_downloader->disableHttpRequests();

        $https_html = $website_downloader->download('https://en.wikipedia.org/wiki/Proxy_pattern');
        $this->assertInternalType('string', $https_html);

        $website_downloader->download('http://en.wikipedia.org/wiki/Proxy_pattern');
    }

    /** @test */
    public function html_downloader_proxy_can_reenable_http_website_download()
    {
        $website_downloader = new \ProxyPatterns\ProtectionProxy\HtmlDownloaderProxy();
        $website_downloader->disableHttpRequests();
        $website_downloader->enableHttpRequests();

        $http_html = $website_downloader->download('http://en.wikipedia.org/wiki/Proxy_pattern');
        $https_html = $website_downloader->download('https://en.wikipedia.org/wiki/Proxy_pattern');

        $this->assertInternalType('string', $http_html);
        $this->assertInternalType('string', $https_html);
        $this->assertEquals($http_html, $https_html);
    }

}