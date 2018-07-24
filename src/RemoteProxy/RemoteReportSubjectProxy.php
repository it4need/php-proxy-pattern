<?php

namespace ProxyPatterns\RemoteProxy;

use ProxyPatterns\RemoteProxy\Exceptions\ReportNotFoundException;
use Zttp\Zttp;

class RemoteReportSubjectProxy implements IReportSubject
{
    private $report;

    public function __construct($report_url)
    {
        $this->setReport($report_url);
    }

    private function setReport($report_url)
    {
        $json_report = Zttp::get($report_url);
        if ($json_report->status() != 200) {
            throw new ReportNotFoundException();
        }
        $report = json_decode($json_report->getBody());
        $this->report = new RealReportSubject($report->id, $report->owner, $report->score);
    }

    public function generateReport()
    {
        return $this->report->generateReport();
    }

    public function getId()
    {
        return $this->report->getId();
    }

    public function getOwner()
    {
        return $this->report->getOwner();
    }

    public function getScore()
    {
        return $this->report->getScore();
    }
}