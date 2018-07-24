<?php

namespace ProxyPatterns\RemoteProxy;

interface IReportSubject
{
    public function generateReport();

    public function getId();

    public function getOwner();

    public function getScore();
}