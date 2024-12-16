<?php

namespace App\Traits;

trait UrlEncoder
{
    public function encodeUuid(string $value) : string
    {
        return substr(hash('sha256', $value . microtime()), 0, 6);
    }


    public function encodeUrlToDigits(string $url, int $digits = 6): string
    {
        // Character set: 0-9, a-z, A-Z
        $charset = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $base = strlen($charset); // 62 characters

        // Generate a hash of the URL (e.g., using md5)
        $hash = md5($url);

        // Convert the hash to a numeric value using base_convert
        $num = base_convert(substr($hash, 0, 8), 16, 10); // Take first 8 characters of the hash

        // Create the encoded string
        $encoded = '';
        for ($i = 0; $i < $digits; $i++) {
            $remainder = $num % $base;
            $encoded = $charset[$remainder] . $encoded;
            $num = (int)($num / $base);
        }

        return $this->encodeUuid($encoded);
    }
}
