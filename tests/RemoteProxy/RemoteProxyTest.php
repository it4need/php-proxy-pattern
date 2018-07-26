<?php

use ProxyPatterns\RemoteProxy\Exceptions\ReportNotFoundException;
use ProxyPatterns\RemoteProxy\RemoteReportSubjectProxy;

class RemoteProxyTest extends PHPUnit\Framework\TestCase
{
    private $test_server;

    public function __construct()
    {
        parent::__construct();
        $this->test_server = 'http://' . getenv('TEST_HTTP_HOST');
    }

    /** @test */
    public function remote_http_404_not_found_request_resolved_into_exception()
    {
        $this->expectException(ReportNotFoundException::class);
        new RemoteReportSubjectProxy($this->test_server . '/thisTestDoesntExist.php');
    }

    /** @test */
    public function get_correct_values_after_report_subject_creation()
    {
        $report = new \ProxyPatterns\RemoteProxy\RealReportSubject('A_343', "server_a", 99);

        $this->assertEquals('A_343', $report->getId());
        $this->assertEquals("server_a", $report->getOwner());
        $this->assertEquals(99, $report->getScore());
    }

    /** @test */
    public function get_correct_from_remote_report()
    {
        $report = new \ProxyPatterns\RemoteProxy\RemoteReportSubjectProxy($this->test_server . '/SimulateRemoteRequest.php');

        $this->assertEquals('B_93756', $report->getId());
        $this->assertEquals("server_b", $report->getOwner());
        $this->assertEquals(81.9, $report->getScore());
    }

    /** @test */
    public function get_correct_report_from_server_remote()
    {
        $report = new \ProxyPatterns\RemoteProxy\RemoteReportSubjectProxy($this->test_server . '/SimulateRemoteRequest.php');

        $this->assertInternalType("string", $report->generateReport());
        $this->assertEquals("Id: B_93756\nOwner: server_b\nScore: 81.9", $report->generateReport());

    }

    /** @test */
    public function get_correct_report_from_local()
    {
        $report = new \ProxyPatterns\RemoteProxy\RealReportSubject('A_352', 'server_a', 17.53);

        $this->assertInternalType("string", $report->generateReport());
        $this->assertEquals("Id: A_352\nOwner: server_a\nScore: 17.53", $report->generateReport());
    }
}