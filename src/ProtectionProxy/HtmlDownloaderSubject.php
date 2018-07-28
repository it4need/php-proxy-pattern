<?php

namespace ProxyPatterns\ProtectionProxy;

use Zttp\Zttp;

class HtmlDownloaderSubject implements IHtmlDownloader
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