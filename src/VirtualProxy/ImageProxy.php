<?php

namespace ProxyPatterns\VirtualProxy;

class ImageProxy implements IImage
{

    private $image;
    private $subject;

    public function __construct($image)
    {
        $this->image = $image;
    }

    public function getSize()
    {
        if ($this->subject == null) {
            $this->subject = new ImageSubject($this->image);
        }

        return $this->subject->getSize();
    }

}