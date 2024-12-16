<?php

namespace App\Services;

use App\Models\Url;

interface ShortCodeGeneratorInterface
{
    public function generate(array $requestData): ?Url;
    public function generateAndVerifyUniquenessFromDatabase(array $requestData): ?Url;
}
