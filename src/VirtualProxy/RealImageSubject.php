<?php

namespace ProxyPatterns\VirtualProxy;

class RealImageSubject implements IImage
{
    protected $img_data;

    public function __construct($image)
    {
        $this->img_data = file_get_contents($image);
    }

    public function getSize()
    {
        $img_properties = getimagesizefromstring($this->img_data);

        return ['width' => $img_properties[0], 'height' => $img_properties[1]];
    }

}