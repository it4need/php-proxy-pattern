<?php

namespace ProxyPatterns\RemoteProxy;

interface IReport
{
    public function generateReport();

    public function getId();

    public function getOwner();

    public function getScore();
}