<?php

namespace App\Traits;

trait UrlEncoder
{
    public static function encodeBase62($value)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $base = strlen($characters);
        $encoded = '';

        while ($value > 0) {
            $encoded = $characters[$value % $base] . $encoded;
            $value = intval($value / $base);
        }

        return $encoded;
    }

    public function encodeUuid(string $value) : string
    {
        return substr(hash('sha256', $value . microtime()), 0, 6);
    }
}
