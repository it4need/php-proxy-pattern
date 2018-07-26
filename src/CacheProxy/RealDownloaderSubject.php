<?php

namespace ProxyPatterns\CacheProxy;

use ProxyPatterns\CacheProxy\Exceptions\FileNotFoundException;
use Zttp\Zttp;

class RealDownloaderSubject implements IDownloader
{
    public function download($url)
    {
        $content = Zttp::get($url);
        if ($content->status() != 200) {
            throw new FileNotFoundException();
        }
        return (string)$content->getBody();
    }
}