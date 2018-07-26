<?php
/**
 * Created by PhpStorm.
 * User: janschloesser
 * Date: 27.07.18
 * Time: 00:15
 */

namespace ProxyPatterns\CacheProxy;

class CacheDownloaderProxy implements IDownloader
{
    private $cache = [];
    private $downloader = null;

    public function download($url)
    {
        if ($this->downloader == null) {
            $this->downloader = new RealDownloaderSubject();
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