<?php

namespace App\Services;

use App\Traits\UrlEncoder;
use Illuminate\Support\Str;

class ShortCodeGenerator implements ShortCodeGeneratorInterface
{
    // use UrlEncoder;

    public function generate(string $url) : string
    {
        return Str::random(6);
    }
}
