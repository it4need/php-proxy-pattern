<?php

class CacheProxyTest extends PHPUnit\Framework\TestCase
{
    private $test_server;

    public function __construct()
    {
        parent::__construct();
        $this->test_server = 'http://' . getenv('TEST_HTTP_HOST');
    }

    /** @test */
    public function successfully_download_ressource_without_cache()
    {
        $downloader = new \ProxyPatterns\CacheProxy\DownloaderSubject();
        $json = $downloader->download($this->test_server . '/SimulateRemoteRequest.php');
        $json2 = $downloader->download($this->test_server . '/SimulateRemoteRequest.php');

        $this->assertInternalType('string', $json);
        $this->assertInternalType('string', $json2);
        $this->assertEquals($json, $json2);
    }

    /** @test */
    public function successfully_download_ressource_with_cache()
    {
        $downloader = new \ProxyPatterns\CacheProxy\DownloaderProxy();
        $url = $this->test_server . '/SimulateRemoteRequest.php';

        $this->assertEquals(false, $downloader->isAlreadyCached($url));
        $json = $downloader->download($url);

        $this->assertEquals(true, $downloader->isAlreadyCached($url));
        $json2 = $downloader->download($url);

        $this->assertInternalType('string', $json);
        $this->assertInternalType('string', $json2);
        $this->assertEquals($json, $json2);
    }

    /** @test */
    public function remote_http_404_not_found_request_resolved_into_exception()
    {
        $this->expectException(\ProxyPatterns\CacheProxy\Exceptions\FileNotFoundException::class);
        (new \ProxyPatterns\CacheProxy\DownloaderSubject)->download($this->test_server . '/thisTestDoesntExist.php');
    }
}