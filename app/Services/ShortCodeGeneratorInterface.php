<?php

namespace App\Services;

interface ShortCodeGeneratorInterface
{
    public function generate(string $url): string;
}
