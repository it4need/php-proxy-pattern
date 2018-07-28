<?php

namespace ProxyPatterns\CacheProxy;

class DownloaderProxy implements IDownloader
{
    private $cache = [];
    private $downloader = null;

    public function download($url)
    {
        if ($this->downloader == null) {
            $this->downloader = new DownloaderSubject();
        }

        if (!empty($this->cache[$url])) {
            return $this->cache[$url];
        }
        $this->cache[$url] = $this->downloader->download($url);
        return $this->cache[$url];
    }

    public function isAlreadyCached($url)
    {
        return !empty($this->cache[$url]) ? true : false;
    }
}