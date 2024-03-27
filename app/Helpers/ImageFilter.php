<?php

namespace App\Helpers;

use Intervention\Image\Filters\FilterInterface;

class ImageFilter implements FilterInterface
{
    const BLUR_VAL = 15;

    private $blur;

    public function __construct($blur = null)
    {
        $this->blur = $blur ?? self::BLUR_VAL;
    }

    public function applyFilter(\Intervention\Image\Image $image)
    {
        return $image->fit(400, 400)
            ->blur($this->blur)
            ->greyscale();
    }
}
