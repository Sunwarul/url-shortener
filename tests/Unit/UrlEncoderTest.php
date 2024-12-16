<?php

use PHPUnit\Framework\TestCase;

class UrlEncoderTest extends TestCase
{
    // Helper class to use the trait
    private $encoder;

    protected function setUp(): void
    {
        $this->encoder = new class {
            use \App\Traits\UrlEncoder; // Adjust the namespace to match your project
        };
    }

    public function test_encodeUuid_generates_correct_length()
    {
        $result = $this->encoder->encodeUuid('test-value');
        $this->assertIsString($result);
        $this->assertEquals(6, strlen($result), 'encodeUuid should return a string of 6 characters.');
    }

    public function test_encodeUuid_uniqueness()
    {
        $value = 'test-value';
        $result1 = $this->encoder->encodeUuid($value);
        $result2 = $this->encoder->encodeUuid($value);
        $this->assertNotEquals($result1, $result2, 'encodeUuid should generate unique strings.');
    }

    public function test_encodeUrlToDigits_returns_correct_length()
    {
        $url = 'https://example.com';
        $digits = 6;
        $result = $this->encoder->encodeUrlToDigits($url, $digits);
        $this->assertIsString($result);
        $this->assertEquals($digits, strlen($result), 'encodeUrlToDigits should return a string of the specified length.');
    }

    public function test_encodeUrlToDigits_handles_different_digits()
    {
        $url = 'https://example.com';
        $digits = 6;
        $result = $this->encoder->encodeUrlToDigits($url, $digits);
        $this->assertIsString($result);
        $this->assertEquals($digits, strlen($result), 'encodeUrlToDigits should adjust the string length based on digits.');
    }

    public function test_encodeUrlToDigits_generates_unique_strings()
    {
        $url1 = 'https://example.com';
        $url2 = 'https://different.com';

        $result1 = $this->encoder->encodeUrlToDigits($url1);
        $result2 = $this->encoder->encodeUrlToDigits($url2);

        $this->assertNotEquals($result1, $result2, 'encodeUrlToDigits should generate unique strings for different URLs.');
    }
}
