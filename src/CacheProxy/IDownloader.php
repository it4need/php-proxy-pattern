<?php

namespace ProxyPatterns\CacheProxy;

interface IDownloader
{
    public function download($url);
}