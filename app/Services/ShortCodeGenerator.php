<?php

namespace App\Services;

use App\Models\Url;
use App\Traits\UrlEncoder;
use Illuminate\Support\Facades\Auth;

class ShortCodeGenerator implements ShortCodeGeneratorInterface
{
    use UrlEncoder;

    public function generate(array $requestData): ?Url
    {
        $shortCode = null;
        $try = 0;
        do {
            $shortCode = $this->encodeUrlToDigits($requestData['original_url']);
            $try += 1;
        } while (Url::where('short_code', $shortCode)->exists() && $try < 3);

        if ($shortCode !== null) {
            $url = Url::create([
                'original_url' => $requestData['original_url'],
                'short_code' => $shortCode,
                'expire_at' => Auth::check() ? today()->addYears(5) : today()->addDays(7),
                'created_by' => Auth::id(),
            ]);
            return $url;
        }
    }
}
